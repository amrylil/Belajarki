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
        Schema::create('course_tag', function (Blueprint $table) {
            // Pivot tidak wajib punya ID sendiri, tapi foreign key harus UUID
            $table->foreignUuid('course_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('tag_id')->constrained()->onDelete('cascade');

            // Mencegah duplikasi tag di course yang sama
            $table->primary(['course_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_tag');
    }
};
