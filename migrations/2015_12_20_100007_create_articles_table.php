<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->index();
            $table->string('title')->index();
            $table->string('alias')->index();
            $table->string('author_alias')->nullable()->index();
            $table->string('blade_template')->nullable();
            $table->text('body')->nullable();
            $table->dateTime('publish_up')->nullable();
            $table->dateTime('publish_down')->nullable();
            $table->text('parameters')->nullable();
            $table->unsignedInteger('order')->default(1);
            $table->integer('hits')->default(0);
            $table->boolean('published')->default(false)->index();
            $table->boolean('authenticated')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('is_page')->default(false);
            $table->string('authorization', 20)->default('can');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('article_permission', function (Blueprint $table) {
            $table->unsignedInteger('article_id')->index();
            $table->unsignedInteger('permission_id')->index();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_permission');
        Schema::drop('articles');
    }
}
