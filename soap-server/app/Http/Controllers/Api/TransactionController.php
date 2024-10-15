<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChargeBalanceRequest;
use App\Http\Requests\ConfirmPaymentRequest;
use App\Http\Requests\RequestPaymentRequest;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\Operations;
use App\Traits\SoapResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Support\Facades\Mail;

use App\Mail\PaymentVerification;


class TransactionController extends Controller
{
    use SoapResponse;

    /**
     * @param ChargeBalanceRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function chargeBalance(ChargeBalanceRequest $request)
    {
        try {
            $customer = app(Customer::class)->getCustomer($request);
            if (is_null($customer)) {
                $message = __('No registered customer found for this document and phone');
                throw new \Exception($message, ResponseAlias::HTTP_NOT_FOUND);
            }

            $wallet = app(Wallet::class)->getWalletOfACustomer($customer);

            $data = [
                ...$request->all(),
                'type' => Transaction::INCOME,
                'wallet_id' => $wallet->_id
            ];

            $currentBalance = $wallet->balance;

            $balance = app(Operations::class)->calculateBalance(Transaction::INCOME, $currentBalance, $request->amount);

            Transaction::query()
                ->create($data);

            app(Wallet::class)->setBalanceOfACustomer($customer, $balance);

            $this->body['cod_error'] = '00';
            $this->body['success'] = true;
            $this->body['data'] = __('Balance successfully added, your current balance is :amount', [
                'amount' => Helper::col_amount_format($balance)
            ]);
            $code = ResponseAlias::HTTP_CREATED;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $code = ResponseAlias::HTTP_CONFLICT;
            $this->body['cod_error'] = $e->getCode();
            $this->body['message_error'] = $e->getMessage();
        }

        return $this->response($this->body, $code);
    }

    /**
     * @param RequestPaymentRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function requestPayment(RequestPaymentRequest $request)
    {
        try {
            $customer = app(Customer::class)->getCustomer($request);
            if (is_null($customer)) {
                $message = __('No registered customer for this document and phone');
                throw new \Exception($message, ResponseAlias::HTTP_NOT_FOUND);
            }

            $wallet = app(Wallet::class)->getWalletOfACustomer($customer);

            if ($request->amount > $wallet->balance) {
                $message = 'Insufficient funds, request not approved';
                throw new \Exception($message, ResponseAlias::HTTP_NOT_ACCEPTABLE);
            }

            $payment = $wallet->payments()->create([
                'session_id' => session()->getId(),
                'token' => Helper::generate_token(),
                'amount' => $request->amount,
                'approved' => false
            ]);


            Mail::to($customer->email)->send(new PaymentVerification($payment));

            $this->body['cod_error'] = '00';
            $this->body['success'] = true;
            $this->body['data'] = 'To confirm payment, check your email.';
            $code = ResponseAlias::HTTP_CREATED;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $code = ResponseAlias::HTTP_CONFLICT;
            $this->body['cod_error'] = $e->getCode();
            $this->body['message_error'] = $e->getMessage();
        }

        return $this->response($this->body, $code);
    }

    /**
     * @param ConfirmPaymentRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function confirmPayment(ConfirmPaymentRequest $request)
    {
        try {
            $customer = Customer::query()
                ->where('document', $request->document)
                ->first();
            if (is_null($customer)) {
                $message = __('No registered customer found for the document');
                throw new \Exception($message, ResponseAlias::HTTP_NOT_FOUND);
            }

            $wallet = Wallet::query()
                ->where('customer_id', $customer->_id)
                ->first();

            if (is_null($wallet)) {
                $message = __('No registered wallet fot the customer');
                throw new \Exception($message, ResponseAlias::HTTP_NOT_FOUND);
            }

            $payment = Payment::query()
                ->where('wallet_id', $wallet->_id)
                ->where('token', $request->token)
                ->where('session_id', $request->session_id)
                ->first();

            if (is_null($payment)) {
                $message = __('No payment record');
                throw new \Exception($message, ResponseAlias::HTTP_NOT_FOUND);
            }

            if ($payment->approved) {
                $message = __('This payment request has already been approved');
                throw new \Exception($message, ResponseAlias::HTTP_CONFLICT);
            }

            $payment->update([
                'approved' => true
            ]);

            $currentBalance = $customer->wallet->balance;

            $balance = app(Operations::class)->calculateBalance(Transaction::EGRESS, $currentBalance, $payment->amount);

            $data = [
                'document' => $customer->document,
                'phone' => $customer->phone,
                'amount' => $payment->amount,
                'type' => Transaction::EGRESS,
                'wallet_id' => $customer->wallet->_id
            ];

            Transaction::query()->create($data);

            app(Wallet::class)->setBalanceOfACustomer($customer, $balance);

            $this->body['cod_error'] = '00';
            $this->body['success'] = true;
            $this->body['data'] = __('Payment approved, you current balance is :amount', [
                'amount' => Helper::col_amount_format($balance)
            ]);
            $code = ResponseAlias::HTTP_CREATED;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $code = ResponseAlias::HTTP_CONFLICT;
            $this->body['cod_error'] = $e->getCode();
            $this->body['message_error'] = $e->getMessage();
        }

        return $this->response($this->body, $code);
    }
}
