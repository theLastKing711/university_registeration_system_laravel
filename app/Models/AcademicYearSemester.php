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
     * Get all of the departmentRegisterationPeriod for the AcademicYearSemester
     */
    public function departmentRegisterationPeriod(): HasMany
    {
        return $this->hasMany(DepartmentRegisterationPeriod::class);
    }

    /**
     * The departments that belong to the AcademicYearSemester
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_registeration_periods');
    }

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
