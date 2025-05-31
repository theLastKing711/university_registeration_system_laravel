<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    /** @use HasFactory<\Database\Factories\ClassroomFactory> */
    use HasFactory;

    /**
     * Get all of the classroomCourses for the classroom
     */
    public function classroomCourseTeachers(): HasMany
    {
        return $this->hasMany(ClassroomCourseTeacher::class);
    }

    /**
     * The courseTeachers  that belong to the classroom
     */
    public function courseTeachers(): BelongsToMany
    {
        return $this->belongsToMany(CourseTeacher::class, 'exams');
    }

    /**
     * Get all of the exams for the Classroom
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
