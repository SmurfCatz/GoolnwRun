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
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade'); // ใช้ foreignId เท่านั้น
            $table->string('event_name');
            $table->enum('event_category', ['Race', 'Virtual Run']);
            $table->date('event_date');
            $table->string('event_location');
            $table->string('event_province');
            $table->date('registration_open_date');
            $table->date('registration_close_date');
            $table->enum('event_status', ['open', 'closed', 'upcoming']);
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
