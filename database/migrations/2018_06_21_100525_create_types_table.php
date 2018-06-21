<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            // foreign key for image 1..1
            $table->unsignedInteger('image_id');
            $table->foreign('image_id')->references('id')->on('images');
            // foreign key for article 1..N
            $table->unsignedInteger('article_id');
            $table->foreign('article_id')->references('id')->on('article');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
