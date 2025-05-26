<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseAttendance extends Pivot
{
    /**
     * Get the student that owns the CourseAttendance
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'student_id',
            'id'
        );
    }

    /**
     * Get the classroomCourseTeacher that owns the CourseAttendance
     */
    public function classroomCourseTeacher(): BelongsTo
    {
        return $this->belongsTo(
            ClassroomCourseTeacher::class,
            'classroom_course_teacher_id',
            'id'
        );
    }
}
