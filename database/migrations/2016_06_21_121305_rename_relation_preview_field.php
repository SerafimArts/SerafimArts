<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameRelationPreviewField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function() {
            Schema::table('article_previews', function(Blueprint $t) {
                $t->uuid('relation_id')->index();
            });
            foreach (\Domains\Article\MainPageArticle::all() as $p) {
                $p->relation_id = $p->related_article;
            }
            Schema::table('article_previews', function(Blueprint $t) {
                $t->dropColumn('related_article');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function() {
            Schema::table('article_previews', function(Blueprint $t) {
                $t->uuid('related_article')->index();
            });
            foreach (\Domains\Article\MainPageArticle::all() as $p) {
                $p->related_article = $p->relation_id;
            }
            Schema::table('article_previews', function(Blueprint $t) {
                $t->dropColumn('relation_id');
            });
        });
    }
}
