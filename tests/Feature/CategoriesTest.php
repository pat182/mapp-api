<?php

namespace Tests\Feature;

use Tests\TestCase;
use Modules\Auth\Services\AuthService;
use Modules\User\Entities\Repositories\UserRepository;


class CategoriesTest extends TestCase
{
    public function testCategoryVaidation()
    {
        // $user = UserRepository::newF()->make();

        $cred = (new AuthService(new UserRepository()))->login([
                "username" => 'pat182',
                "password" => 'test182!@#'            
        ]);
        $dummyData = [
            
            "description" => "outdoors item"
        ];

        $res = $this->json('POST', 'api/categories',$dummyData,[
            'Accept' => 'application/json',
            'Authorization' => "Bearer {$cred['token']}"
        ]);
        $res->assertStatus(422);
    }
    public function testCreateNewCategorySuccess()
    {

        // $user = UserRepository::newF()->make();

        $cred = (new AuthService(new UserRepository()))->login([
                "username" => 'pat182',
                "password" => 'test182!@#'            
        ]);
        
        $dummyData = [
            "name" => "outdoors",
            "description" => "outdoors item"
        ];
        
        $this->json('POST', 'api/categories', $dummyData, [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$cred['token']}"
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
                "data" => [
                    "name",
                    "description",
                    "user",
                    "updated_at",
                    "created_at",
                    "id"
                ]
            ]);

    }


}
