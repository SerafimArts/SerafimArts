<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlePreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_previews', function (Blueprint $t) {
            $t->uuid('id')->primaryKey()->unique();
            $t->enum('size', ['1', '2', '3'])->default('1');
            $t->enum('type', ['Video', 'Text', 'Html', 'Plank'])->default('Text');
            $t->text('content')->nullable();
            $t->string('image')->nullable();
            $t->string('video')->nullable();
            $t->smallInteger('order_id')->nullable();
            $t->uuid('related_article')->nullable()->index();
            $t->string('button_description')->default('Читать дальше');
        });

        Schema::table('articles', function (Blueprint $t) {
            $t->dropColumn([
                'content_open',
                'is_main',
                'video',
                'image',
                'size'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_previews');

        Schema::table('articles', function (Blueprint $t) {
            $t->string('content_open')->nullable();
            $t->boolean('is_main')->default(false);
            $t->string('video')->nullable();
            $t->string('image')->nullable();
            $t->smallInteger('size')->default(1);
        });
    }
}
