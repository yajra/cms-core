<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFileAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('type', 20)->index();
            $table->string('category', 20)->index();
            $table->string('url', 512);
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
        Schema::drop('file_assets');
    }
}
