<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTeacher extends Pivot
{
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
     * The students that belong to the CourseTeacher
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all of the course for the CourseTeacher
     */
    public function courseRegisterations(): HasMany
    {
        return $this->hasMany(CourseRegisteration::class);
    }
}
