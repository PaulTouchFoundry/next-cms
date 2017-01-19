<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->string('title');
            $table->string('headline');
            $table->text('content')->nullable();
            $table->integer('next_block_id')->unsigned()->nullable();
            $table->enum('block_type', ['icon_list','media','text','embed','featured','table'])
                ->nullable();
            $table->json('icon_list')->nullable();
            $table->boolean('quicklink');
            $table->index('page_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blocks');
    }
}
