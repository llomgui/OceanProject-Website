<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutobansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autobans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bot_id')->index();
            $table->integer('xatid');
            $table->string('regname');
            $table->integer('hours');
            $table->string('method');
            $table->timestamps();
            $table->foreign('bot_id')->references('id')->on('bots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('autobans');
    }
}