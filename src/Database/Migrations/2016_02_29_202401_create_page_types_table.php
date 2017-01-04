<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('slug')->nullable();
            $table->string('short_url')->nullable();
            $table->string('template');
            $table->integer('block_quota')->unsigned()->default(0);
            $table->boolean('callout')->default(0);
            $table->json('features');
            $table->json('fields');
            $table->json('blocks');
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
        Schema::drop('page_types');
    }
}
