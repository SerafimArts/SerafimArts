<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $t){
            $t->uuid('id')->primaryKey()->unique();
            $t->string('url')->unique()->index();
            $t->string('title', 255);

            $t->uuid('user_id')->index();
            $t->uuid('category_id')->index()->nullable();

            $t->text('preview')->nullable();
            $t->text('preview_rendered')->nullable();
            $t->longText('content')->nullable();
            $t->longText('content_rendered')->nullable();
            $t->boolean('is_draft')->default(true);

            $t->timestamp('publish_at')->nullable();
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
        Schema::drop('articles');
    }
}
