<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video-details', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->string('video_description');
        $table->string('category');
        $table->string('thumb_image');
        $table->string('cast_name');
        $table->string('director_name');
        $table->string('musicdirector');
        $table->string('producer');
        $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('video-details');

    }
}
