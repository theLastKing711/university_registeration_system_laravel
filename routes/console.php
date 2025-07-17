<?php

use App\Enum\Currency;
use App\Models\UsdCurrencyExchangeRate;
use App\Services\CurrencyConverterService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function (CurrencyConverterService $currency_converter_service) {

    try {
        $response =
           $currency_converter_service
               ->FromUsdToSyp();

        $syp_exchange_rate =
            $response['rates']['SYP']['rate'];

        UsdCurrencyExchangeRate::query()
            ->firstWhere(
                'currency',
                Currency::SYP->value
            )
            ->update([
                'rate' => $syp_exchange_rate,
            ]);

    } catch (\Throwable $th) {
        throw $th;
    }

})->hourly();
