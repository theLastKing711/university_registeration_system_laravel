<?php

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// for notifications
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
Broadcast::channel('teachers.{id}', function (User $user, int $id) {

    // return $id === 1;
    return true;
});

// other way to write it teachers.{id}
// Broadcast::channel('teachers.{teacher}', function (User $user, Teacher $teacher) {

//     return $teacher->id === 2;
//     // return true;
// });
