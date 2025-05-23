<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    /** @use HasFactory<\Database\Factories\ClassroomFactory> */
    use HasFactory;

    /**
     * Get all of the courseRegisterationClassrooms for the classroom
     */
    public function courseRegisterationClassrooms(): HasMany
    {
        return $this->hasMany(CourseRegiterationClassRoom::class, 'classroom_id', 'id');
    }
}
