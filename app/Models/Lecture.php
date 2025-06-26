<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecture extends Model
{
    /** @use HasFactory<\Database\Factories\LectureFactory> */
    use HasFactory;

    /**
     * Get the courseTeacher that owns the Lecture
     */
    public function courseTeacher(): BelongsTo
    {
        return $this->belongsTo(
            CourseTeacher::class,
            'course_teacher_id'
        );
    }

    /**
     * Get all of the courseAttendances for the Lecture
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(CourseAttendance::class);
    }

    /**
     * The students that belong to the Lecture
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'student_id');
    }
}
