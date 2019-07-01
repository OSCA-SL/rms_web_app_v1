<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('logger');
            $table->decimal('frequency', 8, 4); // in MHz
            $table->unsignedBigInteger('contact_user');
            $table->unsignedBigInteger('added_by');
            $table->string('details')->nullable();
            $table->timestamps();
        });
        /*Schema::connection('mysql_r')->create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('logger');
            $table->decimal('frequency', 8, 4); // in MHz
            $table->unsignedBigInteger('contact_user');
            $table->unsignedBigInteger('added_by');
            $table->string('details')->nullable();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
//        Schema::connection('mysql_r')->dropIfExists('channels');
    }
}
