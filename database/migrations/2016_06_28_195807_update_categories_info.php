<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateCategoriesInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::table('categories', function (Blueprint $t) {
                $t->string('color', 6)->nullable();
            });

            Schema::table('categories', function (Blueprint $t) {
                $t->dropColumn('description');
            });

            /** @var \Domains\Article\Category $category */
            foreach (\Domains\Article\Category::all() as $category) {
                $category->changeColor();
                $category->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            Schema::table('categories', function (Blueprint $t) {
                $t->text('description')->nullable();
            });


            Schema::table('categories', function (Blueprint $t) {
                $t->dropColumn('color');
            });
        });
    }
}
