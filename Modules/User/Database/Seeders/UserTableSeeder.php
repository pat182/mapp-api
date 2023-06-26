<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Repositories\{UserRepository,UserProfileRepository};


class UserTableSeeder extends Seeder
{
  
    public function run()
    {   

        $user = UserRepository::newF();
        $userP = UserProfileRepository::newF();
        
        $user->count(2)->sequence([

                'username'=>'pat182',
                'role' => 1,
                'email' => 'thebackdoors182@gmail.com'

            ],
            [

                'username' => 'patUser',
                'role' => 2,
                'email' => 'patrick.chua182@gmail.com'

        ])->create()->each(function($user) use ($userP){
            $p = $userP->make();
            $user->userProfile()->save($p);
        });
        

    }
}
