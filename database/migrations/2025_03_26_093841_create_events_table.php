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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('event_date');
            $table->string('category');
            $table->json('competition_types');  // ใช้ JSON แทน String สำหรับหลายประเภท
            $table->string('location');
            $table->date('registration_start');
            $table->date('registration_end');
            $table->json('medal_images')->nullable(); // แก้ไขจาก 'madal_image' เป็น 'medal_images' และใช้ JSON
            $table->string('shirt_image')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
