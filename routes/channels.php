<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{id}', function ($user, $id) {
    $conv = Conversation::find($id);
    return $conv && (
        $conv->citizen_id === $user->id ||
        $conv->office_id  === $user->office_id
    );
});
