<?php

namespace App\Rules\Admin\ExamStudent;

use Attribute;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Attributes\Validation\CustomValidationAttribute;
use Spatie\LaravelData\Support\Validation\References\FieldReference;
use Spatie\LaravelData\Support\Validation\References\RouteParameterReference;
use Spatie\LaravelData\Support\Validation\ValidationPath;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class RegisteredInExamCourseStudentRule extends CustomValidationAttribute
{
    public function __construct(public FieldReference $exam_id_field_reference, public RouteParameterReference $z) {}

    /**
     * @return array<object|string>|object|string
     */
    public function getRules(ValidationPath $path): array|object|string
    {

        Log::info($path->property('test_id'));

        Log::info($this->exam_id_field_reference->getValue($path));

        Log::info($this->z->getValue());

        return [
            new RegisteredInExamCourseStudent(
                exam_id: (int) $this->z->getValue()
            ),
        ];
    }
}
