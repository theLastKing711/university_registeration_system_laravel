<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    /**
     * Get all of the courseRegiteration for the Student
     */
    public function courses(): HasMany
    {
        return $this->hasMany(CourseRegisteration::class, 'teacher_id', 'id');
    }
}
