<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoriesInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function(Blueprint $t) {
            $t->string('color', 6);
            $t->dropColumn('description');
        });
        
        /** @var \Domains\Article\Category $category */
        foreach (\Domains\Article\Category::all() as $category) {
            $category->changeColor();
            $category->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function(Blueprint $t) {
            $t->text('description')->nullable();
            $t->dropColumn('color');
        });
    }
}
