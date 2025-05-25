<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomCourse extends Pivot
{
    /**
     * Get the classroom that owns the ClassroomCourse
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * Get the course that owns the ClassroomCourse
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
