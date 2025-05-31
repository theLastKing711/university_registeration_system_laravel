<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTeacher extends Pivot
{
    protected $table = 'course_teacher';

    /**
     * Get the course that owns the CourseTeacher
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the teacher that owns the CourseTeacher
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the classrooms that owns the CourseTeacher
     */
    public function classrooms(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'course_teacher_id');
    }

    /**
     * Get all of the exams for the CourseTeacher
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'course_teacher_id');
    }
}
