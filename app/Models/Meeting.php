<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meeting extends Model
{
    /** @use HasFactory<\Database\Factories\MeetingFactory> */
    use HasFactory;

    /**
     * The attendances that belong to the Meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User, $this, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function attendances(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
