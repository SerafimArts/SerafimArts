<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveArticlePreviewsSizeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_previews', function(Blueprint $t) {
            $t->dropColumn('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_previews', function(Blueprint $t) {
            $t->enum('size', ['1', '2', '3'])->default('1');
        });
    }
}
