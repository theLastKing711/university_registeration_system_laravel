<?php

namespace App\Data\Data\Services\CurrencyConverterService\ConvertCurrency\Response;

use Spatie\LaravelData\Data;

class ConvertCurrencyResponse extends Data
{
    public function __construct(
        public string $status,
        public string $updated_date,
        public int $amount,
        public string $base_currency_name,
        public mixed $rate,

    ) {}
}
