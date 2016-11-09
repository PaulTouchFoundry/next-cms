<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageHeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_hero', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->string('hero_title')->nullable();
            $table->json('hero_buttons')->nullable();
            $table->integer('hero_media_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('page_id');
            $table->index('hero_media_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('page_hero');
    }
}
