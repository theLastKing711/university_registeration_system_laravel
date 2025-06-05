<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentCourseRegisteration extends Pivot
{
    protected $table = 'student_course_registerations';

    /**
     * Get the student that owns the StudentCourseRegisteration
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the course that owns the StudentCourseRegisteration
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(OpenCourseRegisteration::class, 'course_id');
    }
}
