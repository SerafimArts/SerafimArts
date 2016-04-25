<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function(Blueprint $t){
            $t->uuid('id')->primaryKey()->unique();
            $t->string('title')->unique();
        });

        Schema::table('users', function(Blueprint $t){
            $t->uuid('group_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_groups');
        Schema::table('users', function(Blueprint $t){
            $t->dropColumn('group_id');
        });
    }
}
