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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name'); // ชื่อแพ็กเกจ
            $table->decimal('package_price', 10, 2); // ราคาค่าบริการ
            $table->integer('package_maxparticipants')->nullable(); // จำนวนผู้เข้าร่วมสูงสุด (null = ไม่จำกัด)
            $table->decimal('package_extra_fee_per_person', 10, 2)->default(0); // ค่าบริการเพิ่มต่อคน
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
