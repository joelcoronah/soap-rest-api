<?php

namespace App\Models;

use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;
use MongoDB\Laravel\Eloquent\Model;


class Wallet extends Model
{
    protected $collection = 'wallets';

    protected $primaryKey = '_id';

    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * @param $customer
     * @return mixed
     */
    public function getBalanceOfACustomer($customer): mixed
    {
        $customer->fresh();

        $wallet = $this->getWalletOfACustomer($customer);

        return $wallet->balance;
    }

    /**
     * @param $customer
     * @param $balance
     * @return void
     */
    public function setBalanceOfACustomer($customer, $balance): void
    {
        $customer->fresh();

        $wallet = $this->getWalletOfACustomer($customer);

        $wallet->update([
            'balance' => $balance
        ]);
    }

    /**
     * @param $customer
     * @return Wallet
     */
    public function getWalletOfACustomer($customer): Wallet
    {
        $customer->fresh();

        $wallet = Wallet::query()
            ->where('customer_id', $customer->_id)
            ->first();

        if (is_null($wallet)) {
            $wallet = $customer->wallet()->create([
                'balance' => 0,
            ]);
        }

        return $wallet;
    }
}
