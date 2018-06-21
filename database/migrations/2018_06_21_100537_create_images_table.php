<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            // foreign key for image 1..1
            $table->unsignedInteger('matter_id');
            $table->foreign('matter_id')->references('id')->on('matters');
            // foreign key for type 1..1
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
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
        Schema::dropIfExists('images');
    }
}
