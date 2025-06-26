<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseAttendance extends Pivot
{
    /** @use HasFactory<\Database\Factories\CourseAttendanceFactory> */
    use HasFactory;

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
    public function lecture(): BelongsTo
    {
        return $this->belongsTo(
            Lecture::class,
        );
    }
}
