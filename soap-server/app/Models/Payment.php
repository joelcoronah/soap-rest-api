<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Payment extends Model
{
    protected $collection = 'payments';

    protected $primaryKey = '_id';

    protected $guarded = [];


    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
