<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;

    /**
     * Get the classroomCourseTeacher that owns the ClassroomCourseTeacher
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
