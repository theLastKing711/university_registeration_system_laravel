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

    public function registerations(): HasMany
    {
        return $this->hasMany(CourseRegisteration::class, 'course_id', 'id');
    }

    /**
     * The departments that belong to the Course
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

    /**
     * The classrooms that belong to the Course
     */
    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class);
    }

    /**
     * Get all of the courseDepartments for the Course
     */
    public function courseDepartments(): HasMany
    {
        return $this->hasMany(CourseDepartment::class);
    }

    public function classroomCourses(): HasMany
    {
        return $this->hasMany(ClassroomCourse::class);
    }
}
