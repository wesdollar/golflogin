<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatsToFloats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->integer("18_tournament_avg")->change();
            $table->integer("18_avg")->change();
            $table->integer("9_avg")->change();
            $table->integer("fir")->change();
            $table->integer("gir")->change();
            $table->integer("ppg")->change();
            $table->integer("ppr")->change();
            $table->integer("up_and_downs")->change();
            $table->integer("par_saves_per_round")->change();
            $table->integer("sand_saves")->change();
            $table->integer("par_or_better")->change();
            $table->integer("par_breakers")->change();
            $table->integer("par_3_avg")->change();
            $table->integer("par_4_avg")->change();
            $table->integer("par_5_avg")->change();
            $table->integer("handicap_index")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stats', function (Blueprint $table) {
            //
        });
    }
}
