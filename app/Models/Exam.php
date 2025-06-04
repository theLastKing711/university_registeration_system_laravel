<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Exam extends Pivot
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;

    protected $table = 'exams';

    /**
     * The students that belong to the Exam
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'exam_student', 'exam_id',
            'student_id'
        );
    }

    /**
     * Get all of the examStudents for the Exam
     */
    public function examStudents(): HasMany
    {
        return $this->hasMany(
            ExamStudent::class,
            'exam_id',
            'id'
        );
    }
}
