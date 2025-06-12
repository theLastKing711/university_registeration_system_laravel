<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentRegisterationPeriod extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentRegisterationPeriod> */
    use HasFactory;

    /**
     * Get the department that owns the DepartemntOpenForCourseRegisterationSemesterYear
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
