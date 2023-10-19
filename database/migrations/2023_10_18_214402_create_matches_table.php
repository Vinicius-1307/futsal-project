<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->unsignedBigInteger('teamA_id');
            $table->foreign('teamA_id')->references('id')->on('teams');
            $table->unsignedBigInteger('teamB_id');
            $table->foreign('teamB_id')->references('id')->on('teams');
            $table->unsignedBigInteger('goalsTeamA')->default(0);
            $table->unsignedBigInteger('goalsTeamB')->default(0);
            $table->string('result')->nullable();
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
        Schema::dropIfExists('match');
    }
}
