<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticleMatter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('article_matter', function(Blueprint $table){
          $table->unsignedInteger('article_id')->index();
          $table->foreign('article_id')->references('id')->on('articles');
          $table->unsignedInteger('matter_id')->index();
          $table->foreign('matter_id')->references('id')->on('matters');
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
        //
    }
}
