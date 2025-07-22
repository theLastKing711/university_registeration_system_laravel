<?php

namespace Tests\Unit\UsdCurrencyExchangeRate\Actions;

use App\Actions\Admin\UsdCurrencyExchangeRate\UpdateUsdSypExchangeRateAction;
use App\Enum\Currency;
use App\Models\UsdCurrencyExchangeRate;
use Database\Seeders\UsdCurrencyExchangeRateSeeder;
use Tests\TestCase;

class UpdatesSypExchangeRateActionTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->
            seed([
                UsdCurrencyExchangeRateSeeder::class
            ]);

    }


    public function test_that_true_is_true(): void
    {

        $new_usd_syp_exchange_rate = 
            1300;

        $updated_usd_syp_exchange_rate = 
            new UpdateUsdSypExchangeRateAction()
            ->execute($new_usd_syp_exchange_rate);


        $this
            ->assertTrue(
                $updated_usd_syp_exchange_rate
                            ->currency == Currency::SYP->value
            );

        $this
            ->assertTrue(
                $updated_usd_syp_exchange_rate
                            ->rate == $new_usd_syp_exchange_rate
            );

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
