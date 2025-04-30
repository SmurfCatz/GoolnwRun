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
        Schema::create('organizers', function (Blueprint $table) {
            $table->id();
            $table->string('organizer_name');
            $table->string('organizer_email')->unique();
            $table->timestamp('organizer_email_verified_at')->nullable();
            $table->string('organizer_password');
            $table->string('organizer_tel')->nullable();
            $table->string('organizer_details')->nullable();
            $table->string('organizer_idcard')->nullable();
            $table->string('organizer_experience')->nullable();
            $table->string('organizer_image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizers');
    }
};
