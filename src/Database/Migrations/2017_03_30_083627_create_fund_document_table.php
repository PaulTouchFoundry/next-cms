<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_document', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route');
            $table->string('page_name');
            $table->string('product_name');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_document');
    }
}
