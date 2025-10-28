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
        Schema::create('timers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_match_id');
            $table->integer('main_timer_seconds')->default(1200);
            $table->integer('raid_timer_seconds')->default(30);
            $table->enum('active_side', ['left', 'right', 'none'])->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('team_match_id')->references('id')->on('team_matches')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timers');
    }
};
