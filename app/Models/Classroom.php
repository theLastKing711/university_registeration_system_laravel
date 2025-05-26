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
     * The courses that belong to the classroom
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            OpenCourseRegisteration::class,
            'classroom_course_teacher',
            'course_id'
        );
    }

    /**
     * The courses that belong to the classroom
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'classroom_course_teacher');
    }

    /**
     * Get all of the classroomCourses for the classroom
     */
    public function classroomCourseTeachers(): HasMany
    {
        return $this->hasMany(ClassroomCourseTeacher::class);
    }
}
