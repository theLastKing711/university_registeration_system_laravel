<?php

namespace Database\Seeders;

use App\Enum\Currency;
use App\Models\UsdCurrencyExchangeRate;
use Illuminate\Database\Seeder;

class UsdCurrencyExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (Currency::cases() as $currency) {

            UsdCurrencyExchangeRate::create([
                'currency' => $currency->name,
                'rate' => fake()->numberBetween(500, 1000).'.00',
            ]);
        }

    }
}
