<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Events\MessageSent;

class ComplainController extends Controller
{
    /**
     * Tampilkan halaman chat admin — kirim semua user berperan 'client'.
     */
    public function index()
    {
        $clients = User::where('role', 'client')->get();

        return view('admin.complaint.keluhan', compact('clients'));
    }

    /**
     * Ambil atau buat conversation antara admin (auth) dan client.
     * Admin bergabung ke conversation yang sudah ada milik client,
     * atau membuat conversation baru jika client belum pernah memulai chat.
     */
    public function getOrCreateConversation(Request $request, $clientId)
    {
        $adminId = auth()->id();

        // 1. Cari conversation private yang sudah ada untuk client ini
        //    (conversation yang dibuat FrontendController saat client login)
        $conversation = Conversation::where('type', 'private')
            ->whereHas('users', function ($q) use ($clientId) {
                $q->where('users.id', $clientId);
            })
            ->oldest()
            ->first();

        if ($conversation) {
            // Conversation ditemukan — pastikan admin sudah ada di pivot
            $alreadyJoined = $conversation->users()
                ->where('users.id', $adminId)
                ->exists();

            if (!$alreadyJoined) {
                $conversation->users()->attach(
                    $adminId, ['role' => 'cs', 'joined_at' => now()]
                );
            }
        } else {
            // Belum ada conversation sama sekali — buat baru
            $conversation = Conversation::create([
                'type'       => 'private',
                'created_by' => $adminId,
            ]);

            $conversation->users()->attach([
                $adminId  => ['role' => 'cs',     'joined_at' => now()],
                $clientId => ['role' => 'client',  'joined_at' => now()],
            ]);
        }

        return response()->json([
            'conversation_id' => $conversation->id,
        ]);
    }

    /**
     * Ambil semua pesan dalam sebuah conversation.
     */
    public function getMessages($conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);

        $messages = Message::where('conversation_id', $conversationId)
            ->with('sender:id,name,role')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) {
                return [
                    'id'         => $msg->id,
                    'body'       => $msg->body,
                    'sender_id'  => $msg->sender_id,
                    'sender'     => $msg->sender,
                    'created_at' => $msg->created_at->toISOString(),
                ];
            });

        return response()->json(['messages' => $messages]);
    }

    /**
     * Kirim pesan dari admin ke client.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'body'            => 'required|string|max:5000',
        ]);

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id'       => auth()->id(),
            'body'            => $request->body,
        ]);

        $message->load('sender:id,name,role');

        // Broadcast ke channel Reverb jika event tersedia
        try {
            broadcast(new MessageSent($message))->toOthers();
        } catch (\Exception $e) {
            // Reverb belum aktif — abaikan, pesan tetap tersimpan
        }

        return response()->json([
            'id'         => $message->id,
            'body'       => $message->body,
            'sender_id'  => $message->sender_id,
            'sender'     => $message->sender,
            'created_at' => $message->created_at->toISOString(),
        ]);
    }
}
