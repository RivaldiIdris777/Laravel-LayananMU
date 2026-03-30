<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    // Mengizinkan mass-assignment untuk semua field kecuali ID
    protected $guarded = ['id'];

    /**
     * Relasi ke tabel messages (Satu percakapan punya banyak pesan)
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Relasi ke tabel users melalui pivot conversation_user
     * (Satu percakapan bisa dimiliki 2 atau banyak user)
     */
    public function users()
    {
        // Menyertakan kolom-kolom tambahan yang ada di tabel pivot migration Anda
        return $this->belongsToMany(User::class, 'conversation_user')
                    ->withPivot(['role', 'joined_at', 'last_read_at', 'is_muted', 'muted_until'])
                    ->withTimestamps();
    }
}
