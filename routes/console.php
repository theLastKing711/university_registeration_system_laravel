<?php

use App\Actions\Admin\UsdCurrencyExchangeRate\UpdateUsdSypExchangeRateAction;
use App\Enum\Currency;
use App\Models\UsdCurrencyExchangeRate;
use App\Services\CurrencyConverterService;
use App\Services\UsdCurrencyExchangeRate\UsdCurrencyExchangeRateService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::call(function (CurrencyConverterService $currency_converter_service) {

//     try {
//         $syp_exchange_rate =
//            $currency_converter_service
//                ->FromUsdToSyp();

//         UsdCurrencyExchangeRate::query()
//             ->firstWhere(
//                 'currency',
//                 Currency::SYP->value
//             )
//             ->update([
//                 'rate' => $syp_exchange_rate,
//             ]);

//     } catch (\Throwable $th) {
//         throw $th;
//     }

// })->everyMinute();

Schedule::call(function (UsdCurrencyExchangeRateService $usd_currency_exchange_rate_service) {

    $usd_currency_exchange_rate_service
        ->updateUsdSypExchangeRateFromAnExternalApi();

})->everyMinute();

Schedule::call(function (UpdateUsdSypExchangeRateAction $usd_currency_exchange_rate_service) {

    $usd_currency_exchange_rate_service
        ->execute(200);

})->everySecond();
