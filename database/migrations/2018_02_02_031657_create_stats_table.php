<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('group_id');
            $table->mediumInteger('rounds_played');
            $table->decimal('18_tournament_avg', 5, 2);
            $table->decimal('18_avg', 5, 2);
            $table->decimal('9_avg', 5, 2);
            $table->decimal('fir', 5, 4);
            $table->decimal('gir', 5, 4);
            $table->decimal('ppg', 4, 2);
            $table->decimal('ppr', 5, 2);
            $table->decimal('up_and_downs', 5, 4);
            $table->decimal('par_saves_per_round', 4, 2);
            $table->decimal('sand_saves', 5, 4);
            $table->decimal('par_or_better', 5, 4);
            $table->decimal('par_breakers', 5, 4);
            $table->decimal('par_3_avg', 4, 2);
            $table->decimal('par_4_avg', 4, 2);
            $table->decimal('par_5_avg', 4, 2);
            $table->mediumInteger('hole_in_ones');
            $table->mediumInteger('double_eagles');
            $table->mediumInteger('eagles');
            $table->mediumInteger('birdies');
            $table->mediumInteger('pars');
            $table->mediumInteger('bogies');
            $table->mediumInteger('double_bogies');
            $table->mediumInteger('three_over_plus');
            $table->decimal('handicap_index', 3, 1);
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
        Schema::dropIfExists('stats');
    }
}
