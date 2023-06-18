<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Role\Database\Seeders\RoleTableSeeder;
use Modules\User\Database\Seeders\UserTableSeeder;
use Modules\Products\Database\Seeders\ProductTableSeeder;
use Modules\Products\Database\Seeders\CategoriesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Model::unguard();
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        
    }
}
