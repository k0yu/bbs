<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('board_tag', function (Blueprint $table) {
			$table->integer('board_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			
			$table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
			
			$table->unique(['board_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::drop('tags');
		Schema::drop('board_tag');
    }
}
