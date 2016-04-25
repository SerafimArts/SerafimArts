<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesSimilar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_similar', function(Blueprint $t) {
            $t->uuid('id')->primaryKey()->unique();
            $t->uuid('article_id')->index();
            $t->uuid('related_article_id')->index();
            $t->integer('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles_similar');
    }
}
