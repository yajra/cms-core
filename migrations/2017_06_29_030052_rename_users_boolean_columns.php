<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RenameUsersBooleanColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('administrator', 'is_admin');
            $table->renameColumn('confirmed', 'is_activated');
            $table->renameColumn('blocked', 'is_blocked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('is_admin', 'administrator');
            $table->renameColumn('is_blocked', 'blocked');
            $table->renameColumn('is_activated', 'confirmed');
        });
    }
}
