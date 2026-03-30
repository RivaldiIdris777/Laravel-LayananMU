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
        Schema::create('graduation', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('npm')->nullable();
            $table->string('major')->nullable();
            $table->string('year')->nullable();
            $table->string('status_job')->nullable();
            $table->string('status_major_now')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation');
    }
};
