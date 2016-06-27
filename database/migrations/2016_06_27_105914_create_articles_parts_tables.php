<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesPartsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_series', function(Blueprint $t) {
            $t->uuid('id')->index();
            $t->string('title')->nullable();
            $t->timestamps();
        });

        Schema::create('parts', function(Blueprint $t) {
            $t->uuid('id')->index();
            $t->uuid('series_id')->index();
            $t->integer('part');
            $t->uuid('article_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('part_series');
        Schema::drop('parts');
    }
}
