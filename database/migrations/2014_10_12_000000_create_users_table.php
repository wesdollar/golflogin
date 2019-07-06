<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled')->default('TRUE');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('classification')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->enum('dexterity', ['right', 'left'])->nullable();
            $table->enum('shirt_size', ['xs', 'sm', 'md', 'lg', 'xl', 'xxl', 'xxxl'])->nullable();
            $table->tinyInteger('pant_size_waist')->nullable();
            $table->tinyInteger('pant_size_length')->nullable();
            $table->tinyInteger('shoe_size')->nullable();
            $table->enum('glove_size', ['xs', 'sm', 'md', 'lg', 'xl', 'xxl', 'xxxl'])->nullable();
            $table->string('profile_img')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
