<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CrossListedCourses extends Pivot
{
    /**
     * Get the firstCourse that owns the CrossListedCourses
     */
    public function firstCourse(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'first_course_id');
    }

    /**
     * Get the secondCourse that owns the CrossListedCourses
     */
    public function secondCourse(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'second_course_id');
    }
}
