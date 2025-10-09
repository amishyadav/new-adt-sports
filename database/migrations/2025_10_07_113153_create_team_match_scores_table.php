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
            $table->unsignedBigInteger('team1_id');
            $table->unsignedBigInteger('team2_id');
            $table->integer('team1_score')->nullable();
            $table->integer('team2_score')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('team_match_id')->references('id')->on('team_matches')->onUpdate('cascade');
            $table->foreign('team1_id')->references('id')->on('teams')->onUpdate('cascade');
            $table->foreign('team2_id')->references('id')->on('teams')->onUpdate('cascade');
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
