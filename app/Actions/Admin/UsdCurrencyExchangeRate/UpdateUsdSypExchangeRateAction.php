<?php

namespace App\Actions\Admin\UsdCurrencyExchangeRate;

use App\Enum\Currency;
use App\Models\UsdCurrencyExchangeRate;

class UpdateUsdSypExchangeRateAction
{
    public function execute(int $usd_syp_exchange_rate)
    {

        $usd_syp_exchange_rate = tap(
            UsdCurrencyExchangeRate::query()
                ->firstWhere(
                    'currency',
                    Currency::SYP->value
                ),
            function ($exchange) use ($usd_syp_exchange_rate) {

                $exchange
                    ->update([
                        'rate' => $usd_syp_exchange_rate,
                    ]);
            }
        );

        return
            $usd_syp_exchange_rate
                ->fresh();

    }
}
