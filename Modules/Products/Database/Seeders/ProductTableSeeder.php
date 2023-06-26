<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Products\Entities\Repositories\ProductRepository;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        $product = ProductRepository::newF();
        $product->count(100)->create(); 

    }
         
}
