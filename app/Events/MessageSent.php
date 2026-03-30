<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        // Pastikan relasi sender sudah ter-load sebelum di-serialize
        $this->message = $message->loadMissing('sender');
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('conversation.' . $this->message->conversation_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    /**
     * Payload eksplisit yang dikirim ke client JS.
     * Memastikan struktur data konsisten antara admin & client blade.
     */
    public function broadcastWith(): array
    {
        return [
            'message' => [
                'id'          => $this->message->id,
                'body'        => $this->message->body,
                'sender_id'   => $this->message->sender_id,
                'created_at'  => $this->message->created_at->toISOString(),
                'sender'      => [
                    'id'   => $this->message->sender?->id,
                    'name' => $this->message->sender?->name,
                    'role' => $this->message->sender?->role,
                ],
            ],
        ];
    }
}
