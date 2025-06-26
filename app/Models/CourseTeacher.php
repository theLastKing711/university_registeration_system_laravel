<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTeacher extends Pivot
{
    protected $table = 'course_teacher';

    /**
     * Get the course that owns the CourseTeacher
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(OpenCourseRegisteration::class, 'course_id');
    }

    /**
     * Get the teacher that owns the CourseTeacher
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get all of the lectures for the CourseTeacher
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }

    /**
     * Get all of the classroomCourseTeachers for the CourseTeacher
     */
    public function classroomCourseTeachers(): HasMany
    {
        return
            $this
                ->hasMany(
                    ClassroomCourseTeacher::class,
                    'course_teacher_id'
                );
    }

    public function classrooms(): BelongsToMany
    {
        return
            $this
                ->belongsToMany(
                    Classroom::class,
                    'classroom_course_teacher',
                    'course_teacher_id'
                )
                ->withTimestamps();
    }

    /**
     * Get all of the exams for the CourseTeacher
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'course_teacher_id');
    }

    public function examClassrooms(): BelongsToMany
    {
        return $this->belongsToMany(
            Classroom::class,
            'exams',
            'course_teacher_id'
        );
    }

    /**
     * Get all of the attendances for the CourseTeacher
     */
    public function studenAttendances(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'course_attendance',
            'course_teacher_id',
            'student_id'
        )->withPivot('updated_at');
    }

    /**
     * Get all of the attendances for the CourseTeacher
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(
            CourseAttendance::class,
            'course_teacher_id',
        );
    }
}
