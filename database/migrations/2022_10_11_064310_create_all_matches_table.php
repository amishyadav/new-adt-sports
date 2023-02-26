<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_matches', function (Blueprint $table) {
            $table->id();
            $table->string('match_title');
            $table->unsignedBigInteger('league_id');
            $table->dateTime('start_from')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->boolean('status')->default(1);

            $table->foreign('league_id')
                ->references('id')
                ->on('leagues')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('add_matches');
    }
};
