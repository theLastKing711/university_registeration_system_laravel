<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseRegisteration extends Pivot
{
    /**
     * Get the student that owns the CourseRegisteration
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    /**
     * Get the courseTeacher that owns the CourseRegisteration
     */
    public function courseTeacher(): BelongsTo
    {
        return $this->belongsTo(CourseTeacher::class);
    }
}
