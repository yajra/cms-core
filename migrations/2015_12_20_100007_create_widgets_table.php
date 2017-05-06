<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('extension_id')->index();
            $table->string('title')->index();
            $table->string('position', 50)->index();
            $table->string('template', 100)->default('default')->index();
            $table->string('custom_template', 100)->nullable()->index();
            $table->unsignedSmallInteger('order')->default(1);
            $table->boolean('published')->default(true)->index();
            $table->boolean('show_title')->default(true);
            $table->boolean('authenticated')->default(false);
            $table->text('body')->nullable();
            $table->text('parameters')->nullable();
            $table->string('authorization', 20)->default('can');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->timestamps();

            $table->foreign('extension_id')->references('id')->on('extensions');
        });

        Schema::create('widget_permission', function (Blueprint $table) {
            $table->unsignedInteger('widget_id')->index();
            $table->unsignedInteger('permission_id')->index();

            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        Schema::create('widget_menu', function (Blueprint $table) {
            $table->unsignedInteger('widget_id')->index();
            $table->unsignedInteger('menu_id')->index();

            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('widget_menu');
        Schema::drop('widget_permission');
        Schema::drop('widgets');
    }
}
