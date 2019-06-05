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
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->date('dob')->nullable();
            $table->string('nic')->nullable()->unique();
            $table->string('mobile')->nullable();
            $table->string('land')->nullable();
            $table->string('address')->nullable();
            $table->integer('role')->default(2); // 1 - technical_admin 2 - admin, 3 - artist, 4 - client
            $table->unsignedBigInteger('added_by')->nullable();
            $table->string('comments')->nullable();
            $table->string('image')->default('/images/user.png');
            $table->rememberToken();
            $table->timestamps();
        });

        //insert super admin
        \Illuminate\Support\Facades\DB::table('users')->insert([
                [
                'first_name' => "Super",
                "last_name" => "Admin",
                "email" => "admin@osca.lk",
                "password" => \Illuminate\Support\Facades\Hash::make('Osca@radio'),
                "dob" => "2019-06-01",
                "nic" => "123456789V",
                "role" => 1,
                "added_by" => 0
            ],
            [
                'first_name' => "Vithanage",
                "last_name" => "V",
                "email" => "vithanage@osca.lk",
                "password" => \Illuminate\Support\Facades\Hash::make('Vithanage1234'),
                "dob" => "2019-06-01",
                "nic" => "132456789V",
                "role" => 2,
                "added_by" => 0
            ],
            [
                'first_name' => "Tharanga",
                "last_name" => NULL,
                "email" => "tharanga@osca.lk",
                "password" => \Illuminate\Support\Facades\Hash::make('Tharanga123'),
                "dob" => "2019-06-01",
                "nic" => "123456780V",
                "role" => 2,
                "added_by" => 0
            ],

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
