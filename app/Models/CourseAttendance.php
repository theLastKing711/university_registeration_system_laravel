<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseAttendance extends Pivot
{
    /**
     * Get the student that owns the CourseAttendance
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'student_id',
        );
    }

    /**
     * Get the courseTeacher that owns the CourseAttendance
     */
    public function courseTeacher(): BelongsTo
    {
        return $this->belongsTo(
            CourseTeacher::class,
            'course_teacher_id',
        );
    }
}
