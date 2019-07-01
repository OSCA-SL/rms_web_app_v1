<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('file_path')->nullable();
            $table->string('remote_file_path')->nullable();
            $table->date('released_at')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->string('details')->nullable();
//            $table->integer('status')->default(1); // 1 - active, 2 - approved (active), 3 - pending, 4 - rejected
            $table->timestamps();
        });
        /*Schema::connection('mysql_r')->create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('file_path')->nullable();
            $table->string('remote_file_path')->nullable();
            $table->date('released_at')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->string('details')->nullable();
//            $table->integer('status')->default(1); // 1 - active, 2 - approved (active), 3 - pending, 4 - rejected
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
        Schema::dropIfExists('songs');
//        Schema::connection('mysql_r')->dropIfExists('songs');
    }
}
