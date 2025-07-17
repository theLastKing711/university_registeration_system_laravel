<?php

namespace Database\Factories;

use App\Enum\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsdCurrencyExchangeRate>
 */
class UsdCurrencyExchangeRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'currency' => $this->faker->randomElement(Currency::cases()),
            'rate' => $this->faker->numberBetween('1000', '10000'),
        ];
    }
}
