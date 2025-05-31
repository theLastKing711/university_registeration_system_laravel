<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OpenCourseRegisteration extends Model
{
    /** @use HasFactory<\Database\Factories\OpenCourseRegisterationFactory> */
    use HasFactory;

    /**
     * Get the course that owns the openCourseRegisteration
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
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
}
