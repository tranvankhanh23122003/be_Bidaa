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
        Schema::create('dat_ban', function (Blueprint $table) {
            $table->id();
            $table->date('booking_date');
            $table->string('booking_time');
            $table->string('billiard_type');
            $table->unsignedInteger('table_id'); 



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dat_ban');
    }
};
