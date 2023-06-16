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

        Schema::table( 'categories' , function (Blueprint $table) {

            $table->string( 'user' , 32 )->index();
            $table->foreign( 'user' )->references( 'user_id' )->on( 'user' );

        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        $table->dropColumn('user');

    }

};
