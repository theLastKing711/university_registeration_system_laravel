<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    /**
     * Get the department that owns the Course
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

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
    public function coursesPrerequisites(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'prerequisites',
            'course_id',
            'prerequisite_id'
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
     * Get all of the firstCrossListedCourses for the Course
     */
    public function firstCrossListedCourses(): HasMany
    {
        return $this->hasMany(CrossListedCourses::class, 'first_course_id');
    }

    /**
     * Get all of the SecondCrossListedCourses for the Course
     */
    public function SecondCrossListedCourses(): HasMany
    {
        return $this->hasMany(CrossListedCourses::class, 'second_course_id');
    }
}
