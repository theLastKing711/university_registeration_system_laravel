<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentRegisterationPeriod extends Pivot
{
    /** @use HasFactory<\Database\Factories\DepartmentRegisterationPeriod> */
    use HasFactory;

    public $incrementing = true;

    protected $table = 'department_registeration_periods';

    /**
     * Get the department that owns the DepartemntOpenForCourseRegisterationSemesterYear
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the academicSemesterYear that owns the DepartmentRegisterationPeriod
     */
    public function academicSemesterYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYearSemester::class);
    }
}
