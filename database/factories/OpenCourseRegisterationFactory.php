<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\openCourseRegisteration>
 */
class OpenCourseRegisterationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'semester' => $this->faker->numberBetween(0, 2),
        ];
    }

    public function openFrom2014To2015(): static
    {

        $random_semester = $this->faker->numberBetween(0, 2);

        return
            $this->forEachSequence(
                [
                    'year' => 2014,
                ],
                [
                    'year' => 2015,
                ],

            );
    }

    public function openFrom2014To2019(): static
    {

        $random_semester = $this->faker->numberBetween(0, 2);

        return
            $this->forEachSequence(
                [
                    'year' => 2014,
                    // 'semester' => $random_semester,
                ],
                [
                    'year' => 2015,
                    // 'semester' => $random_semester,
                ],
                // [
                //     'year' => 2016,
                //     // 'semester' => $random_semester,
                // ],
                // [
                //     'year' => 2017,
                //     // 'semester' => $random_semester,
                // ],
                // [
                //     'year' => 2018,
                //     // 'semester' => $random_semester,
                // ],
                // [
                //     'year' => 2019,
                //     // 'semester' => $random_semester,
                // ],
            );
    }

    public function withThreeSemesters(): static
    {

        $random_semester = $this->faker->numberBetween(0, 2);

        return
            $this->forEachSequence(
                [
                    'semester' => 0,
                ],
                [
                    'semester' => 1,
                ],
                [
                    'semester' => 2,
                ],
                [
                    'semester' => 0,
                ],
                [
                    'semester' => 1,
                ],
                [
                    'semester' => 2,
                ],
            );
    }
}
