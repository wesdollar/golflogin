<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatsToFloatsForReal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->float("18_tournament_avg", 8, 2)->change();
            $table->float("18_avg", 8, 2)->change();
            $table->float("9_avg", 8, 2)->change();
            $table->float("fir", 8, 2)->change();
            $table->float("gir", 8, 2)->change();
            $table->float("ppg", 8, 2)->change();
            $table->float("ppr", 8, 2)->change();
            $table->float("up_and_downs", 8, 2)->change();
            $table->float("par_saves_per_round", 8, 2)->change();
            $table->float("sand_saves", 8, 2)->change();
            $table->float("par_or_better", 8, 2)->change();
            $table->float("par_breakers", 8, 2)->change();
            $table->float("par_3_avg", 8, 2)->change();
            $table->float("par_4_avg", 8, 2)->change();
            $table->float("par_5_avg", 8, 2)->change();
            $table->float("handicap_index", 8, 2)->change();
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
