<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    public const TEACHERS = [
        [
            'id' => 1,
            'name' => 'aynman',
        ],
        [
            'id' => 2,
            'name' => 'mousa',
        ],
        [
            'id' => 3,
            'name' => 'shaar',
        ],
        [
            'id' => 4,
            'name' => 'basheer kharat',
        ],
        [
            'id' => 5,
            'name' => 'sa3eed sa3dan',
        ],
        [
            'id' => 6,
            'name' => 'iman',
        ],
        [
            'id' => 7,
            'name' => 'black',
        ],

    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'department_id' => Department::inRandomOrder()->first()->id,
        ];
    }

    public function seedFromItDepartment()
    {

        return $this->forEachSequence(
            ...self::TEACHERS
        );

        // $it_department = Department::query()
        //     ->firstWhere(
        //         'id',
        //         1,
        //     );

        // return
        //     $it_department
        //         ->teachers;

    }

    public function alternateMainTeacher(): static
    {
        return $this->sequence(
            [
                'is_main_teacher' => true,
            ],
            [
                'is_main_teacher' => false,
            ]
        );
    }
}
