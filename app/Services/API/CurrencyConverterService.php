<?php

namespace App\Services\API;

use Illuminate\Support\Facades\Http;

class CurrencyConverterService
{
    private const CONVERT_CURRENCT_PATH = '/currency/convert';

    public function __construct(
        // #[Config('services.currencty_converter.api_key')]
        // protected string $api_key,
    ) {}

    public function FromUsdToSyp(): int
    {

        return
         Http::CurrencyConverter()
             ->withQueryParameters(
                 [
                     'from' => 'USD',
                     'to' => 'SYP',
                     'amount' => 1,
                     'format' => 'json',
                 ]
             )
             ->get(self::CONVERT_CURRENCT_PATH)['rates']['SYP']['rate'];

    }

    // public function FromUsdToSyp(int $value)
    // {

    //     return
    //      Http::CurrencyConverter()
    //          ->withQueryParameters(
    //              [
    //                  'from' => 'USD',
    //                  'to' => 'SYP',
    //                  'amount' => 1,
    //                  'format' => 'json',
    //              ]
    //          )
    //          ->get(self::CONVERT_CURRENCT_PATH);

    // }
}
