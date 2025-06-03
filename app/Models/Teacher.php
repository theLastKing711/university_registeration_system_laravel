<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    /**
     * The courses that belong to the Teacher
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            OpenCourseRegisteration::class,
        );
    }

    /**
     * Get all of the courseTeachers for the Teacher
     */
    public function courseTeachers(): HasMany
    {
        return $this->hasMany(CourseTeacher::class);
    }

    /**
     * Get all of the classroomCourseTeachers for the Teacher
     */
    public function classroomCourseTeachers(): HasMany
    {
        return $this->hasMany(ClassroomCourseTeacher::class);
    }

    /**
     * Get the department that owns the Teacher
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
