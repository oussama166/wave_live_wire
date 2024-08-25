<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    Log::alert('message', ['userId' => $id]);
    return (int) $user->id === (int) $id;
});

Broadcast::channel('NotificationsUser.{userid}', function ($userId) {
    return (int) Auth::user()->id === (int) $userId;
});
