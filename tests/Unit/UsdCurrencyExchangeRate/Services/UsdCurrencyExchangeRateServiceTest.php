<?php

namespace Tests\Unit\UsdCurrencyExchangeRate\Services;

use App\Enum\Currency;
use App\Models\UsdCurrencyExchangeRate;
use App\Services\API\CurrencyConverterService;
use App\Services\UsdCurrencyExchangeRate\UsdCurrencyExchangeRateService;
use Database\Seeders\UsdCurrencyExchangeRateSeeder;
use Mockery\MockInterface;
use Tests\TestCase;

class UsdCurrencyExchangeRateServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->
            seed([
                UsdCurrencyExchangeRateSeeder::class,
            ]);

    }

    public function test_that_true_is_true(): void
    {

        $new_usd_syp_exchange_rate =
            15000;

        $this
            ->mock(
                CurrencyConverterService::class,
                function (MockInterface $mock) use ($new_usd_syp_exchange_rate) {
                    $mock
                        ->shouldReceive('FromUsdToSyp') // the services calls this function
                        ->once() // at least onse
                        ->andReturn($new_usd_syp_exchange_rate); // the value that it returns when called
                });

        app(
            UsdCurrencyExchangeRateService::class
        )
            ->updateUsdSypExchangeRateFromAnExternalApi();

        $this
            ->assertDatabaseHas(
                UsdCurrencyExchangeRate::class,
                [
                    'currency' => Currency::SYP->value,
                    'rate' => $new_usd_syp_exchange_rate,
                ]
            );

    }
}
