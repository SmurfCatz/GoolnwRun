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
            $table->string('competition_type');
            $table->text('details')->nullable();
            $table->string('location');
            $table->date('registration_start');
            $table->date('registration_end');
            $table->json('souvenirs')->nullable(); // เช่น {"medal": true, "shirt": true}
            $table->string('shirt_image')->nullable();
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
