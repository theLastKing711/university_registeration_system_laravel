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
     * Get all of the courseDepartments for the Course
     */
    public function courseDepartments(): HasMany
    {
        return $this->hasMany(CourseDepartment::class);
    }
}
