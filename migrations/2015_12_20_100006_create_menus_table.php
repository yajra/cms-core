<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('navigation', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('type')->unique()->index();
                $table->boolean('published')->default(true)->index();
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->timestamps();
            });

            Schema::create('menus', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('navigation_id')->nullable()->index();
                $table->unsignedInteger('extension_id')->nullable()->index();
                $table->string('title');
                $table->string('url');
                $table->unsignedInteger('parent_id')->nullable()->index();
                $table->unsignedInteger('lft')->nullable()->index();
                $table->unsignedInteger('rgt')->nullable()->index();
                $table->unsignedInteger('depth')->nullable();
                $table->string('icon')->default('link');
                $table->boolean('published')->default(false)->index();
                $table->boolean('authenticated')->default(false)->index();
                $table->string('authorization', 20)->default('can');
                $table->tinyInteger('order')->default(1);
                $table->tinyInteger('target')->default(0);
                $table->text('parameters')->nullable();

                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->timestamps();

                $table->foreign('navigation_id')->references('id')->on('navigation')->onDelete('cascade');
                $table->foreign('extension_id')->references('id')->on('extensions')->onDelete('cascade');
            });

            Schema::create('menu_permission', function (Blueprint $table) {
                $table->unsignedInteger('menu_id')->index();
                $table->unsignedInteger('permission_id')->index();

                $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
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
        DB::transaction(function () {
            Schema::drop('menu_permission');
            Schema::drop('menus');
            Schema::drop('navigation');
        });
    }
}
