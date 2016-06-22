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
        Schema::table('article_previews', function(Blueprint $t) {
            $t->renameColumn('related_article', 'relation_id');
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
            $t->renameColumn('relation_id', 'related_article');
        });
    }
}
