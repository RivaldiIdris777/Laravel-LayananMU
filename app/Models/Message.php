<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Karena di migration ada $table->softDeletes()

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    // Menyesuaikan tipe data casting untuk kolom tertentu
    protected $casts = [
        'is_read' => 'boolean',
        'is_deleted' => 'boolean',
        'read_at' => 'datetime',
        'edited_at' => 'datetime',
    ];

    /**
     * Relasi ke percapakan (Pesan ini milik conversation mana)
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Relasi ke User pengirim pesan (Foreign key: sender_id)
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relasi jika pesan ini adalah balasan (reply) dari pesan lain
     */
    public function repliedTo()
    {
        return $this->belongsTo(Message::class, 'reply_to_id');
    }

    /**
     * Relasi untuk mengambil daftar balasan dari pesan ini
     */
    public function replies()
    {
        return $this->hasMany(Message::class, 'reply_to_id');
    }
}
