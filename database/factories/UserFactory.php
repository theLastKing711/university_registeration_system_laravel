<?php

namespace Database\Factories;

use App\Enum\Auth\RolesEnum;
use App\Models\OpenCourseRegisteration;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'national_id' => (string) $this->faker->randomNumber(6),
            'birthdate' => $this->faker->date(),
            'graduation_date' => null,
            'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::ADMIN);
        });
    }

    public function staticAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin',
            // 'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ])->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::ADMIN);
        });
    }

    public function staticCourseRegisterer(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'cr',
            'password' => Hash::make('cr'),
        ])->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::COURSES_REGISTERER);
        });
    }

    public function staticMarkAssigner(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'ma',
            'password' => Hash::make('ma'),
        ])->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::MARKS_ASSIGNER);
        });
    }

    public function withStudentRole(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(RolesEnum::STUDENT);
        });
    }

    public function fromItDepartment(): static
    {

        return $this->state(fn (array $attributes) => [
            'department_id' => 1,
        ]
        );
    }

    public function fromEnglishDepartment(): static
    {

        return $this->state(fn (array $attributes) => [
            'department_id' => 2,
        ]
        );
    }

    public function enrolledInYear(int $year): static
    {

        return $this->state(fn (array $attributes) => [
            'enrollment_date' => Carbon::createFromFormat('Y', $year)->toDateTimeString(),
        ]
        );
    }

    public function graduatedInYear(int $year): static
    {
        return $this->state(fn (array $attributes) => [
            'graduation_date' => Carbon::createFromFormat('Y', $year)->toDateTimeString(),
        ]
        );
    }

    public function unGraduated(): static
    {
        return $this->state(fn (array $attributes) => [
            'graduation_date' => null,
        ]
        );
    }

    public function withCourses(): static
    {

        return $this->afterCreating(function (User $student) {

            $university_first_open_year =
                2014;

            $student_year =
                Carbon::parse(
                    $student
                        ->enrollment_date
                )
                    ->year;

            // $student_year =
            //     $university_first_open_year
            //     -
            //     $student_year
            //     +
            //     1;

            $registerable_courses_years =
                collect(
                    range(1, $student_year - $university_first_open_year + 1)
                );

            $registerable_courses_years
                ->map(function (int $student_year) use ($student, $university_first_open_year) {

                    $course_year =
                        $university_first_open_year
                        +
                        $student_year
                        -
                        1;

                    $courses_ids =
                        OpenCourseRegisteration::query()
                            ->whereRelation(
                                'academicYearSemester',
                                'year',
                                $course_year
                            )
                            ->whereHas(
                                'course',
                                fn (Builder $query): Builder => $query
                                    ->where('open_for_students_in_year', $student_year)
                            )
                            ->pluck('id');

                    $student
                        ->courses()
                        ->attach($courses_ids, ['final_mark' => 30]);

                });

            // $courses_ids =
            //     OpenCourseRegisteration::query()
            //         ->whereYear(column: 'year', $year)
            //         ->whereHas(
            //             'course',
            //             fn (Builder $query) => $query
            //                 ->whereIn('year', $registerable_courses_years)
            //         )
            //         ->pluck('id');

            // $student
            //     ->courses()
            //     ->attach($courses_ids);

        });
    }
}
