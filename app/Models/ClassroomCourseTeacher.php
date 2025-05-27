<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomCourseTeacher extends Pivot
{
    /**
     * Get the teacher that owns the ClassroomCourseTeacher
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * Get the teacher that owns the ClassroomCourseTeacher
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the course that owns the ClassroomCourseTeacher
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * The students that belong to the ClassroomCourseTeacher
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users', 'student_id',
            'role_id'
        );
    }

    /**
     * Get all of the attendances for the ClassroomCourseTeacher
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(
            CourseAttendance::class,
            'classroom_course_teacher_id',
            'id'
        );
    }

    /**
     * Get all of the exams for the ClassroomCourseTeacher
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'classroom_course_teacher_id', 'id');
    }
}
