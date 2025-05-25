<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public const COURSES = [

        // IT COURSES
        [
            'name' => 'Math1',
            'code' => 'M1',
            'credits' => 2,
        ],
        [
            'name' => 'Math2',
            'code' => 'M2',
            'credits' => 2,
        ],
        [
            'name' => 'Math3',
            'code' => 'M3',
            'credits' => 2,
        ],

        // ENGLISH COURSES
        [
            'name' => 'English1',
            'code' => 'E1',
            'credits' => 2,
        ],
        [
            'name' => 'English2',
            'code' => 'E2',
            'credits' => 2,
        ],
        [
            'name' => 'English3',
            'code' => 'E3',
            'credits' => 2,
        ],

        // BIO COURSES
        [
            'name' => 'Bio1',
            'code' => 'B1',
            'credits' => 2,
        ],
        [
            'name' => 'Bio2',
            'code' => 'B2',
            'credits' => 2,
        ],
        [
            'name' => 'Bio3',
            'code' => 'B3',
            'credits' => 2,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::insert(self::COURSES);
    }
}
