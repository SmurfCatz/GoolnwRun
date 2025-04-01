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
        Schema::create('competition_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // เชื่อมโยงกับตาราง events
            $table->string('name');  // ชื่อประเภทการแข่งขัน
            $table->decimal('price', 10, 2);  // ราคาค่าสมัคร
            $table->string('distance');  // ระยะทาง
            $table->timestamps();  // วันที่สร้างและอัปเดต
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_types');
    }
};
