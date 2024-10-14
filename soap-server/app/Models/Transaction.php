<?php

namespace App\Models;


use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Transaction extends Model
{
    protected $collection = 'transactions';

    protected $primaryKey = '_id';

    protected $guarded = [];

    public const INCOME = 'income';
    public const EGRESS = 'egress';

    public array $types = [
        self::INCOME,
        self::EGRESS
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
