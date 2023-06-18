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
        Schema::create('product_photos', function (Blueprint $table) {

            $table->id();
            $table->bigInteger( 'product' )->unsigned()->index();
            $table->string( 'description' , 255);
            $table->longText('path');
            $table->timestamps();
            $table->foreign( 'product' )->references( 'id' )->on( 'products' );

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_photos');
    }
};
