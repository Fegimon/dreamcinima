<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_gift', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('email');
            $table->string('transaction_id');
            $table->string('address');
            $table->string('user_preference');
            $table->string('subcription')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('delivery_comments')->nullable();
            $table->string('shipping_info')->nullable();
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
        Schema::dropIfExists('user_gift');
    }
}
