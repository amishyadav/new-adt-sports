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
        Schema::create('team_match_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_match_id');
            $table->integer('team1_score')->nullable();
            $table->integer('team2_score')->nullable();
            $table->integer('team1_player_left')->default(7);
            $table->integer('team2_player_left')->default(7);
            $table->boolean('court_swap')->default(0);
            $table->integer('team1_total_raid')->default(0);
            $table->integer('team2_total_raid')->default(0);
            $table->integer('main_timer_seconds')->default(20 * 60);
            $table->integer('raid_timer_seconds_left')->default(30);
            $table->integer('raid_timer_seconds_right')->default(30);
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
        Schema::dropIfExists('team_match_scores');
    }
};
