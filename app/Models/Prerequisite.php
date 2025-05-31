<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prerequisite extends Model
{
    /** @use HasFactory<\Database\Factories\PrerequisiteFactory> */
    use HasFactory;

    /**
     * Get the course that owns the Prerequisite
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * Get the prerequisite that owns the Prerequisite
     */
    public function prerequisite(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'prerequisite_id', 'id');
    }
}
