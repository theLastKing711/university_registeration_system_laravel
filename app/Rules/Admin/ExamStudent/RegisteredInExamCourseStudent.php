<?php

namespace App\Rules\Admin\ExamStudent;

use App\Models\Exam;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Log;

class RegisteredInExamCourseStudent implements ValidationRule
{
    /**
     * Indicates whether the rule should be implicit.
     *
     * @var bool
     */
    public $implicit = true;

    public function __construct(public int $exam_id) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $exams_student_ids, Closure $fail): void
    {
        // Log::info('hello world');

        // Log::info($attribute);

        // Log::info($this->exam_id);

        // Log::info($exams_student_ids);

        // $exam_course_students_ids = Exam::query()
        //     ->with(relations: 'courseTeacher.course.students')
        //     ->firstWhere(
        //         'id',
        //         $this->exam_id
        //     )
        //     ->courseTeacher
        //     ->course
        //     ->students
        //     ->pluck('id');

        // $exams_student_ids
        //     ->each(function ($exam_student) {});

        // $student_has_registered_in_exam_course =
        //             $exam_course_students_ids
        //                 ->contains($exams_student_ids);

        // if (! $student_has_registered_in_exam_course) {
        //     $fail($attribute,
        //         __(
        //             'messages.exam_students.student unregistered in course',
        //             [
        //                 'id' => $student_id,
        //             ]
        //         )
        //     );
        // }

    }
}
