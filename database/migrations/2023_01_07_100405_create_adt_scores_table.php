<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adt_scores', function (Blueprint $table) {
            $table->id();
            $table->string('team_a')->nullable();
            $table->string('team_b')->nullable();
            $table->string('team_a_score')->nullable()->default(00);
            $table->string('team_b_score')->nullable()->default(00);
            $table->integer('round')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adt_scores');
    }
};
