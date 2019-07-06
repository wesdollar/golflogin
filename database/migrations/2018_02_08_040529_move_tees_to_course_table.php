<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveTeesToCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('tee_box')->nullable();
            $table->decimal('rating', 4, 2)->nullable();
            $table->decimal('slope', 5, 2)->nullable();
        });

        Schema::dropIfExists('tees');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['tee_box', 'rating', 'slope']);
        });

        Schema::create('tees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->string('title');
            $table->decimal('rating', 4, 2);
            $table->decimal('slope', 5, 2);
            $table->timestamps();
        });
    }
}
