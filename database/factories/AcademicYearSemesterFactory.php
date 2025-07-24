<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicYearSemester>
 */
class AcademicYearSemesterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'semester' => $this->faker->numberBetween(0, 3),
            'year' => $this->faker->numberBetween(2014, 2016),
        ];
    }

    public function OpenFromYearToYearForEachSequence(int $start_year, int $end_year): static
    {

        $years =
            collect(
                []
            )
                ->range($start_year, $end_year);

        $semesters =
           range(0, 2);

        $years_semesters_cross_join =
            $years
                ->crossJoin(
                    $semesters
                );

        $years_semesters =
            $years_semesters_cross_join
                ->map(
                    callback: fn ($item) => [
                        'year' => $item[0],
                        'semester' => $item[1],
                    ]
                );

        // or
        // $years_semesters =
        //     $years_semesters_cross_join
        //         ->mapSpread(
        //             callback: fn (...$item) => [
        //                 'year' => $item[0],
        //                 'semester' => $item[1],
        //             ]
        //         );

        // or
        // $years_semesters =
        //     $years_semesters_cross_join
        //         ->mapSpread(
        //             fn (int $year, int $semester) => [
        //                 'year' => $year,
        //                 'semester' => $semester,
        //             ]
        //         );

        return
            $this->forEachSequence(
                ...$years_semesters
            );
    }
}
