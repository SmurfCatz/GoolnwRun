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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade'); // เชื่อมโยงกับ member_id ใน members
            $table->string('address_house_number')->nullable();
            $table->string('address_village')->nullable();
            $table->string('address_alley')->nullable();
            $table->string('address_road')->nullable();
            $table->string('address_subdistrict')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_province')->nullable();
            $table->string('address_postal_code')->nullable();
            $table->string('address_country')->default('Thailand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

