<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDreamMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dream_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('media_title');
            $table->string('media_desc');
            $table->string('media_url');
            $table->string('media_thumb')->nullable();
            $table->tinyInteger('showin_home')->default('0');
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
        Schema::dropIfExists('dream_media');
    }
}
