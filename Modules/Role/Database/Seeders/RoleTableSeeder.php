<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Role\Entities\Repositories\RoleRepository;

class RoleTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        Model::unguard();
        
        RoleRepository::insert([
            ['permission' => 'admin'],
            ['permission' => 'user']
        ]);

    }
}
