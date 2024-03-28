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
        Schema::create('match_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_between_team_id')->nullable();
            $table->foreign('match_between_team_id')
                ->references('id')
                ->on('match_between_teams')
                ->onUpdate('cascade');
            $table->string('score_a')->default(0);
            $table->string('score_b')->default(0);
            $table->string('player_left_a')->default(7);
            $table->string('player_left_b')->default(7);
            $table->string('match_part')->default('first_half');
            $table->string('total_match_time')->default(10);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_scores');
    }
};
