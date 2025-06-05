<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\classroom>
 */
class ClassroomFactory extends Factory
{
    public const CLASSROOMS = [
        'A-1',
        'A-2',
        'A-3',
        'A-4',
        'B-1',
        'B-2',
        'B-3',
        'B-4',
        'C-1',
        'C-2',
        'C-3',
        'C-4',
        'D-1',
        'D-2',
        'D-3',
        'D-4',
    ];

    public const CLASS_HOURS = [
        '08:00:00',
        '10:00:00',
        '12:00:00',
        '14:00:00',
        '16:00:00',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $random_start_time = Carbon::createFromTimeString(
            fake()->randomElement(self::CLASS_HOURS)
        );

        $random_end_time = $random_start_time->addHours(2);

        return [
            'name' => fake()->randomElement(array: self::CLASSROOMS),
            'from' => $random_start_time->toTimeString(),
            'to' => $random_end_time->toTimeString(),
        ];
    }
}
