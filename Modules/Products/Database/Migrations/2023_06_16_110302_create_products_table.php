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
        Schema::create( 'products' , function (Blueprint $table) {

            $table->id();
            $table->bigInteger('category')->unsigned()->index();
            $table->string( 'name' , 255 )->index();
            $table->longText( 'description' )->index();
            $table->timestamps();
            $table->foreign( 'category' )->references( 'id' )->on( 'categories' );
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
