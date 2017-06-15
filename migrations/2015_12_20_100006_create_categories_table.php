<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            // nested sets fields
            $table->unsignedInteger('parent_id')->nullable()->index();
            $table->unsignedInteger('lft')->nullable()->index();
            $table->unsignedInteger('rgt')->nullable()->index();
            $table->unsignedInteger('depth')->nullable();

            $table->string('title');
            $table->string('alias')->index();
            $table->string('note')->nullable();
            $table->boolean('published')->default(false)->index();
            $table->boolean('authenticated')->default(false)->index();
            $table->integer('hits')->default(0);
            $table->mediumText('description')->nullable();
            $table->text('parameters')->nullable();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
