<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {

            $table->string('user_id',32)->index();
            $table->string('username',45)->unique();
            $table->string('email')->unique();
            $table->unsignedBigInteger('role');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role')->references('role_id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
