<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Models\Graduation;
use App\Events\MessageSent;

class FrontendController extends Controller
{
    // Layanan Hukum
    public function layananHukum()
    {
        return view('frontend.landingpage.lawfirm');
    }

    // Layanan Trip
    public function layananTrip()
    {
        return view('frontend.landingpage.opentrip');
    }

    // Layanan Complaint
    public function layananComplaint()
    {
        return view('frontend.landingpage.complaint');
    }

    /**
     * Halaman chat client ↔ customer service.
     * Hanya bisa diakses oleh user yang sudah login dengan role 'client'.
     */
    public function chatComplaint()
    {
        // Guard: harus login
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu untuk mengakses fitur chat.');
        }

        // Guard: hanya role 'client'
        if (auth()->user()->role !== 'client') {
            abort(403, 'Halaman ini hanya untuk user client.');
        }

        $clientId = auth()->id();

        // Cari conversation APAPUN yang dimiliki client ini
        // Satu client seharusnya hanya punya satu conversation CS
        $conversation = Conversation::where('type', 'private')
            ->whereHas('users', function ($q) use ($clientId) {
                $q->where('users.id', $clientId);
            })
            ->oldest()
            ->first();

        if (!$conversation) {
            // Belum ada conversation — buat baru dengan CS pertama yang tersedia
            $cs = User::whereIn('role', ['admin', 'cs'])->first();

            if (!$cs) {
                return view('frontend.chat.chatcomplaint', [
                    'conversation' => null,
                    'messages'     => collect(),
                    'cs'           => null,
                ]);
            }

            $conversation = Conversation::create([
                'type'       => 'private',
                'created_by' => $clientId,
            ]);

            $conversation->users()->attach([
                $clientId => ['role' => 'client'],
                $cs->id   => ['role' => 'admin'],
            ]);
        }

        // CS adalah anggota admin dari conversation ini
        $cs = $conversation->users()
            ->whereIn('users.role', ['admin', 'cs'])
            ->first();

        // Ambil semua pesan dalam conversation
        $messages = Message::with('sender')
            ->where('conversation_id', $conversation->id)
            ->where('is_deleted', false)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('frontend.chat.chatcomplaint', compact('conversation', 'messages', 'cs'));
    }

    /**
     * Kirim pesan dari client ke conversation (dipanggil via AJAX).
     */
    public function sendMessageClient(Request $request)
    {
        // Guard: harus login & role client
        if (!auth()->check() || auth()->user()->role !== 'client') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'body'            => 'required|string|max:5000',
        ]);

        // Pastikan client memang anggota conversation ini
        $conversation = Conversation::findOrFail($request->conversation_id);
        if (!$conversation->users->contains(auth()->id())) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id'       => auth()->id(),
            'body'            => $request->body,
            'type'            => 'text',
        ]);

        $message->load('sender');

        // Broadcast ke Reverb — hanya ke pihak lain (CS/admin)
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'status'  => 'success',
            'message' => $message,
        ]);
    }

    // Alumni 

    public function listAlumni()
    {
        $graduations = Graduation::all();
        return view('frontend.alumni.listalumni', compact('graduations'));
    }

    // Profile User


    
}
