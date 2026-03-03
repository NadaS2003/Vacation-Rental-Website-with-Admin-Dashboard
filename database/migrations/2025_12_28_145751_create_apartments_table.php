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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id(); // العمود الأساسي
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('max_persons')->default(1);
            $table->integer('size')->nullable();
            $table->string('view')->nullable();
            $table->integer('num_beds')->default(1);
            $table->unsignedBigInteger('hotel_id'); // المفتاح الخارجي للفنادق
            $table->timestamps();

            // مفتاح خارجي للفنادق (افتراضي إذا عندك جدول hotels)
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
