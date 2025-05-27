<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * The students that belong to the Exam
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'exam_student', 'exam_id', 'student_id');
    }

    /**
     * Get all of the examStudents for the Exam
     */
    public function examStudents(): HasMany
    {
        return $this->hasMany(ExamStudent::class, 'exam_id', 'id');
    }
}
