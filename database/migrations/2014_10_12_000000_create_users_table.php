<?php

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
        Schema::create('_seq', function(Blueprint $t) {
            $t->increments('id');
        });
        Schema::drop('_seq');
        
        Schema::create('users', function (Blueprint $t) {
            $t->uuid('id')->primaryKey()->unique();
            $t->uuid('group_id')->index()->nullable();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('password', 60);
            $t->string('avatar')->nullable();
            $t->rememberToken();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
