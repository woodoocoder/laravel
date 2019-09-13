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

Broadcast::channel('dialog_id.{id}', function ($user, $dialogId) {
    if ($user->canJoinDialog($dialogId)) {
        return ['id' => $user->id, 'firstname' => $user->firstname];
    }
});

Broadcast::channel('dialogs.{toUserId}', function ($user, $toUserId) {
    return $user->id == $toUserId;
});
