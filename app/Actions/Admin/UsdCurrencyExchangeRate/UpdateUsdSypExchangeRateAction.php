<?php

namespace App\Actions\Admin\UsdCurrencyExchangeRate;

use App\Enum\Currency;
use App\Models\UsdCurrencyExchangeRate;
use App\Services\CurrencyConverterService;

class UpdateUsdSypExchangeRateAction
{
    public function __construct(public CurrencyConverterService $currency_converter_service) {}

    public function execute()
    {

        try {
            $syp_exchange_rate =
               $this->currency_converter_service
                   ->FromUsdToSyp();

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

    }
}
