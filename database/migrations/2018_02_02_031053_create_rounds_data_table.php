<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('round_id');
            $table->integer('hole_id');
            $table->tinyInteger('strokes');
            $table->tinyInteger('putts');
            $table->boolean('gir')->nullable();
            $table->boolean('fir')->nullable();
            $table->boolean('up_and_down')->nullable();
            $table->boolean('sand_save')->nullable();
            $table->tinyInteger('penalty_strokes')->default(0);
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
        Schema::dropIfExists('rounds_data');
    }
}
