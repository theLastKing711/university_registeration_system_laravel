<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// must be defined for private channels
// user is the logged in user
Broadcast::channel('teachers', function (User $user) {
    return true;
});

// must be defined for private channels
// user is the logged in user
Broadcast::channel('teachers.{id}', function (User $user) {
    return true;
});
