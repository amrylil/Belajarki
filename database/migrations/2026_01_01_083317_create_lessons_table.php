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
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('module_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->enum('type', ['video', 'text'])->default('video');
            $table->text('content')->nullable();           // URL Video atau Artikel Text
            $table->integer('duration')->default(0);       // Detik atau Menit
            $table->boolean('is_preview')->default(false); // Bisa ditonton gratis?
            $table->integer('sort')->default(0);           // Urutan materi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
