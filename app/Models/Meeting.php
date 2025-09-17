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

    // auto transform value saved in db in format("year-month-day hour-minute-second)
    // after retrieval from data base when called to array on them to carbon value with time zone same above with added (Z) or (+offset) at the end
    protected $casts = [
        'happens_at' => 'datetime',
    ];
}
