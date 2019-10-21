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

            $columnsToAdd = [
                'gir',
                'fir',
                'up_and_down',
                'sand_save'
            ];

            foreach ($columnsToAdd as $column) {
                $table->enum($column, ['n/a', 'yes', 'no']);
            }

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
