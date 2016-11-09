<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')-> nullable();
            $table->string('template')->nullable();
            $table->integer('page_type_id')->unsigned();
            $table->integer('starting_block_id')->unsigned()->nullable();
            $table->json('features');
            $table->boolean('scheduled')->default(0);
            $table->timestamp('schedule_publish_at')->nullable();
            $table->boolean('published');
            $table->timestamp('published_at')->default('0000-00-00 00:00:00');
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
        Schema::drop('pages');
    }
}
