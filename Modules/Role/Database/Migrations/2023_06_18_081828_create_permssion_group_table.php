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

        Schema::create('permission_group', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned()->index();
            $table->bigInteger('permission_id')->unsigned()->index();
        });

        Schema::table('permission_group', function (Blueprint $table) {
            $table->foreign('role_id')
            ->references('role_id')->on('role')
            ->onDelete('cascade');
            $table->foreign('permission_id')
            ->references('permission_id')->on('permission')
            ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_group');
    }
};
