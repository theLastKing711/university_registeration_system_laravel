<?php

use App\Actions\Admin\UsdCurrencyExchangeRate\UpdateUsdSypExchangeRateAction;
use App\Enum\Currency;
use App\Services\UsdCurrencyExchangeRate\UsdCurrencyExchangeRateService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function (UsdCurrencyExchangeRateService $usd_currency_exchange_rate_service) {

    $usd_currency_exchange_rate_service
        ->updateUsdSypExchangeRateFromAnExternalApi();

})->hourly();

// Schedule::call(function (UpdateUsdSypExchangeRateAction $usd_currency_exchange_rate_service) {

//     $usd_currency_exchange_rate_service
//         ->execute(200);

// })->everySecond();
