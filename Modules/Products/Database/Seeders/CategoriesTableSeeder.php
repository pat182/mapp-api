<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Products\Entities\Repositories\CategoryRepository;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = CategoryRepository::newF();

        $categories->count(2)->sequence(
                    [

                        'name' => "outdoors", 

                    ], 
                    [
                        'name' => "indoors",

                    ]
        )->create();

    }
         
}
