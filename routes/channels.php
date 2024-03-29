<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Tasques', function ($user) {
    return $user->isSuperAdmin() || $user->hasRole('TaskManager');
});

Broadcast::channel('App.Counter', function ($user) {
    return [
        'id' => $user->id,
        'name' => $user->name,
        'gravatar' => $user->gravatar
    ];
});
Broadcast::channel('App.Log', function () {
    return true;
});
