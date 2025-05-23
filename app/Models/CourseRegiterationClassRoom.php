<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseRegiterationClassRoom extends Pivot
{
    protected $table = 'course_regiteration_classroom';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Get the courseRegisteration that owns the CourseRegiterationClassRoom
     */
    public function courseRegisteration(): BelongsTo
    {
        return $this->belongsTo(CourseRegisteration::class, 'course_registeration_id', 'id');
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }
}
