<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type', 20)->index();
            $table->boolean('enabled')->default(true);
            $table->boolean('protected')->default(false);
            $table->tinyInteger('order')->default(0);
            $table->text('manifest');
            $table->text('parameters')->nullable();
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
        Schema::drop('extensions');
    }
}
