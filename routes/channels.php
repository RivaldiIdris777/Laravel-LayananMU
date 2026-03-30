<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    // Cek apakah user id ini terdaftar di tabel conversation_user untuk conversationId terkait
    // Asumsi relasi Model User memiliki method ->conversations()
    return $user->conversations()->where('conversation_user.conversation_id', $conversationId)->exists();
});
