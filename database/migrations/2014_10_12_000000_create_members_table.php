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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_name');
            $table->string('member_email')->unique();
            $table->string('member_role')->default('user');
            $table->string('member_gender')->nullable();
            $table->string('member_dob')->nullable();
            $table->string('member_tel')->nullable();
            $table->string('member_nationality')->nullable();
            $table->string('member_image')->nullable();
            $table->timestamp('member_email_verified_at')->nullable();
            $table->string('member_password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
