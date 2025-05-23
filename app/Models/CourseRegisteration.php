<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseRegisteration extends Pivot
{
    protected $table = 'course_registeration';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Get the student that owns the CourseRegisteration
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    /**
     * Get the teacher that owns the CourseRegisteration
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    /**
     * Get the course that owns the CourseRegisteration
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * Get all of the classes for the CourseRegisteration
     */
    public function courseRegisterationClassrooms(): HasMany
    {
        return $this->hasMany(CourseRegiterationClassRoom::class, 'course_registeration_id', localKey: 'id');
    }
}
