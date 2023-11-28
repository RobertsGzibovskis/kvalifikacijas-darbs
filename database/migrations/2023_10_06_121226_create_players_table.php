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
        Schema::create('players', function (Blueprint $table) {
            $table->id('player_id');
            $table->string('name');
            $table->string('surname');
            $table->string('jersey number');
            $table->string('position');
            $table->unsignedBigInteger('statistic_id');
            $table->foreign('statistic_id')->references('id')->on('player_statistics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
