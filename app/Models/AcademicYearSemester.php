<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYearSemester extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicYearSemesterFactory> */
    use HasFactory;

    /**
     * Get all of the comments for the AcademiceYearSemester
     */
    public function openCourseRegisterations(): HasMany
    {
        return $this->hasMany(OpenCourseRegisteration::class);
    }

    /**
     * The courses that belong to the AcademiceYearSemester
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'open_course_registerations');
    }
}
