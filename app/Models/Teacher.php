<?php

namespace App\Models;

use Database\Factories\OpenCourseRegisterationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
            OpenCourseRegisterationFactory::class,
            'classroom_course_teacher',
            'course_id'

        );
    }

    /**
     * The classrooms that belong to the Teacher
     */
    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class, 'classroom_course_teacher');
    }

    /**
     * Get all of the classroomCourseTeachers for the Teacher
     */
    public function classroomCourseTeachers(): HasMany
    {
        return $this->hasMany(ClassroomCourseTeacher::class);
    }
}
