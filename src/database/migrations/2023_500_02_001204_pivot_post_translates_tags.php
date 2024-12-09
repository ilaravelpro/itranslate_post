<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotPostTranslatesTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translates_tags', function (Blueprint $table) {
            $table->integer('translate_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['translate_id' , 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translates_tags');
    }
}
