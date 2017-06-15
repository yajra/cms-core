<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Yajra\CMS\Entities\Category;

class AddCategoryAndArticleSlugField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function(Blueprint $table)
        {
            $table->string('slug')->nullable()->index();
        });

        Schema::table('articles', function(Blueprint $table)
        {
            $table->string('slug')->nullable()->index();
        });

        Category::all()->each->touch();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function(Blueprint $table)
        {
            $table->dropColumn('slug');
        });
        Schema::table('articles', function(Blueprint $table)
        {
            $table->dropColumn('slug');
        });
    }
}
