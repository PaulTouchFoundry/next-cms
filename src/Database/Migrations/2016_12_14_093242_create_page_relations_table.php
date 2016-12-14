<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('related_page_id')->unsigned();
            $table->integer('related_pagetype_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->index('page_id');
            $table->index('related_page_id');
            $table->index('related_pagetype_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('page_relations');
    }
}
