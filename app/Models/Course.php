<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    /**
     * Get all of the prerequisites for the Course
     */
    public function prerequisites(): HasMany
    {
        return $this->hasMany(Prerequisite::class);
    }

    /**
     * The courses that belong to the prerequisite
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'prerequisites',
            'prerequisite_id',
            'course_id'
        );
    }

    /**
     * Get all of the openCourseRegisterations for the Course
     */
    public function openCourseRegisterations(): HasMany
    {
        return $this->hasMany(openCourseRegisteration::class);
    }

    /**
     * The departments that belong to the Course
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

    /**
     * The teachers that belong to the Course
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(related: Teacher::class);
    }

    /**
     * Get all of the courseTeachers for the Course
     */
    public function courseTeachers(): HasMany
    {
        return $this->hasMany(CourseTeacher::class);
    }

    /**
     * Get all of the courseDepartments for the Course
     */
    public function courseDepartments(): HasMany
    {
        return $this->hasMany(CourseDepartment::class);
    }
}
