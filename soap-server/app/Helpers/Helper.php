<?php

namespace App\Helpers;

use Illuminate\Support\Str;


class Helper
{

    /**
     * @param $amount
     * @return string
     */
    public static function col_amount_format($amount): string
    {
        $amount = isset($amount) && is_numeric($amount) ? (float) $amount : 0;
        return '$' . number_format($amount, 2, ',', '.');
    }

    /**
     * @throws Exception
     */
    public static function generate_token(): string
    {
        return (string) random_int(100000, 999999);
    }
}
