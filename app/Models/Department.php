<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    /**
     * Get all of the students for the Department
     */
    public function students(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the courses for the Department
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * The teachers that belong to the Department
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class);
    }
}
