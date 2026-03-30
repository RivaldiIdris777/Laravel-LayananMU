<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conversation_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('role', ['admin', 'user','client','cs'])->default('client')->comment('Role dalam grup');
            $table->timestamp('joined_at')->useCurrent()->comment('Waktu bergabung ke conversation');
            $table->timestamp('last_read_at')->nullable()->comment('Untuk menghitung unread messages');
            $table->boolean('is_muted')->default(false)->comment('Apakah notifikasi di-mute');
            $table->timestamp('muted_until')->nullable()->comment('Mute sampai kapan, null = selamanya');

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Satu user hanya bisa bergabung satu kali per conversation
            $table->unique(['conversation_id', 'user_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_user');
    }
};