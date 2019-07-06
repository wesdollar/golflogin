<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTeesIdColumnOnHoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holes', function (Blueprint $table) {
            $table->renameColumn('tees_id', 'course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('holes', function (Blueprint $table) {
            $table->renameColumn('course_id', 'tees_id');
        });
    }
}
