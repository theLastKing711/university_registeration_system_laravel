<?php

namespace App\Services\UsdCurrencyExchangeRate;

use App\Actions\Admin\UsdCurrencyExchangeRate\UpdateUsdSypExchangeRateAction;
use App\Services\API\CurrencyConverterService;

class UsdCurrencyExchangeRateService
{
    public function __construct(
        private CurrencyConverterService $currency_converter_service,
        private UpdateUsdSypExchangeRateAction $update_usd_syp_exchange_rate_action
    ) {}

    public function updateUsdSypExchangeRateFromAnExternalApi()
    {

        $usd_syp_exchange_rate =
            $this
                ->currency_converter_service
                ->FromUsdToSyp();

        $this
            ->update_usd_syp_exchange_rate_action
            ->execute($usd_syp_exchange_rate);

    }
}
