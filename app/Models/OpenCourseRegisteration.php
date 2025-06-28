<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OpenCourseRegisteration extends Pivot
{
    /** @use HasFactory<\Database\Factories\OpenCourseRegisterationFactory> */
    use HasFactory;

    public $incrementing = true;

    protected $table = 'open_course_registerations';

    /**
     * Get the course that owns the openCourseRegisteration
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the academicYearSemester that owns the OpenCourseRegisteration
     */
    public function academicYearSemester(): BelongsTo
    {
        return $this->belongsTo(AcademicYearSemester::class);
    }

    /**
     * The teachers that belong to the openCourseRegisteration
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            Teacher::class,
            'course_teacher',
            'course_id'
        );
    }

    /**
     * Get all of the CourseTeachers for the openCourseRegisteration
     */
    public function courseTeachers(): HasMany
    {
        return $this->hasMany(
            CourseTeacher::class,
            'course_id',
            'id'
        );
    }

    /**
     * Get the students that owns the openCourseRegisteration
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'student_course_registerations',
            'course_id',
            'student_id'
        );
    }

    /**
     * Get all of the studentCourseRegisterations for the openCourseRegisteration
     */
    public function studentCourseRegisterations(): HasMany
    {
        return $this->hasMany(
            StudentCourseRegisteration::class,
            'course_id'
        );
    }

    #[Scope]
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     **/
    protected function getStudents(Builder $query, int $id): void
    {
        $query->where('votes', '>', 100);
    }
}
