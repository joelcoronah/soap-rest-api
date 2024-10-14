<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;

class Customer extends Model
{
    use Notifiable;

    protected $collection = 'customers';

    protected $primaryKey = '_id';

    protected $guarded = [];

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * @param $request
     * @return Customer|null
     */
    public function getCustomer($request): null|Customer
    {
        return Customer::query()
            ->where('document', $request->document)
            ->where('phone', $request->mobile)
            ->first();
    }
}
