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
            $table->timestamps();
			
			$table->foreign('board_id')->references('id')->on('boards');
			$table->foreign('tag_id')->references('id')->on('tags');
			
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
    }
}
