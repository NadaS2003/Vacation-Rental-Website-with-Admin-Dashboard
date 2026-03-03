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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // العمود الأساسي
            $table->string('name');
            $table->string('email');
            $table->string('phone_numbers');
            $table->string('check_in');
            $table->string('check_out');
            $table->integer('days')->default(1);
            $table->unsignedBigInteger('user_id')->nullable(); // مفتاح خارجي للمستخدم
            $table->decimal('price', 8, 2)->default(0);
            $table->string('room_name');
            $table->string('hotel_name');
            $table->string('status')->default('processing'); // مثال: processing, confirmed, cancelled
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
