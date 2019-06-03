<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('dob');
            $table->string('nic')->nullable();
            $table->string('mobile')->nullable();
            $table->string('land')->nullable();
            $table->string('address')->nullable();
            $table->integer('role')->default(2); // 1 - technical_admin 2 - admin, 3 - artist, 4 - client
            $table->unsignedBigInteger('added_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        //insert super admin
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'first_name' => "Super",
            "last_name" => "Admin",
            "email" => "admin@osca.lk",
            "password" => \Illuminate\Support\Facades\Hash::make('Osca@radio'),
            "dob" => "2019-06-01",
            "nic" => "123456789V",
            "role" => 1,
            "added_by" => 0
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
