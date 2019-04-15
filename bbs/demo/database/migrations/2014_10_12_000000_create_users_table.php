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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('uid');
            $table->string('user_name', 32);
            $table->string('user_email', 150);
            $table->string('password', 60);
            $table->string('user_kind', 1)->default('G');
            $table->date('user_regTime');

            $table->unique(['user_name'], 'user_name');
            $table->unique(['user_email'], 'user_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
