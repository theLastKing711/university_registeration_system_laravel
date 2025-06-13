<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
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

    protected function scopeLatestOpenTimeForStudents(Builder $query, int $department_id): void
    {
        $query
            ->where('department_id', $department_id)
            ->where('is_open_for_students', true)
            ->orderBy('year', 'desc')
            ->orderBy('semester', 'desc');
    }

    #[Scope]
    protected function latestOpenTime(Builder $query, int $department_id): void
    {
        $query
            ->where('department_id', $department_id)
            ->orderBy('year', 'desc')
            ->orderBy('semester', 'desc');
    }

    // protected function latestOpenTimeForStudents(int $department_id)
    // {
    //     return
    //         $this
    //             ->latestOpenTimeForStudentsQuery($department_id)
    //             ->first();
    // }
}
