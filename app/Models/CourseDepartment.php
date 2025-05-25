<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseDepartment extends Pivot
{
    /**
     * Get the course that owns the CourseDepartment
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the department that owns the CourseDepartment
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
