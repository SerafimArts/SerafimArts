<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $t){
            $t->uuid('id')->primaryKey()->unique();
            $t->uuid('user_id')->index();
            $t->uuid('article_id')->index();
            $t->text('content');
            $t->text('content_rendered');
            $t->boolean('approved')->default(false);
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
        Schema::drop('comments');
    }
}
