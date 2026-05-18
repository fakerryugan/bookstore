<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{customerId}', function ($user, $customerId) {
    return (int) $user->id === (int) $customerId || $user->role === 'admin' || $user->role === 'costumer';
});
