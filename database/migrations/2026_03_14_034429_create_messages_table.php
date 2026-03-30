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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('sender_id');
            $table->text('body')->nullable()->comment('Isi pesan teks');
            $table->enum('type', ['text', 'image', 'file', 'audio', 'video'])->default('text');
            $table->string('attachment_url')->nullable()->comment('URL file/gambar jika ada attachment');
            $table->string('attachment_name')->nullable()->comment('Nama file asli');
            $table->string('attachment_size')->nullable()->comment('Ukuran file dalam bytes');
            $table->unsignedBigInteger('reply_to_id')->nullable()->comment('ID pesan yang di-reply');
            $table->boolean('is_read')->default(false)->comment('Status dibaca (untuk private chat)');
            $table->timestamp('read_at')->nullable()->comment('Waktu pesan dibaca');
            $table->timestamp('edited_at')->nullable()->comment('Waktu pesan diedit');
            $table->boolean('is_deleted')->default(false)->comment('Soft delete untuk pesan');

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reply_to_id')->references('id')->on('messages')->onDelete('set null');

            // Index untuk query yang sering dipakai
            $table->index(['conversation_id', 'created_at']);
            $table->index(['sender_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};