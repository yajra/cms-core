<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTagsTable extends Migration
{
    public function up()
    {
        Schema::table('tagging_tags', function (Blueprint $table) {
            $table->integer('tag_group_id')->unsigned()->nullable()->after('id');
            $table->foreign('tag_group_id', 'tag_group_id_foreign')->references('id')->on('tagging_tag_groups');
        });
    }

    public function down()
    {
        Schema::table('tagging_tags', function ($table) {
            $table->dropForeign('tag_group_id_foreign');
            $table->dropColumn('tag_group_id');
        });
    }
}
