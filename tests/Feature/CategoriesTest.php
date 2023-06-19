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
                "password" => 'test123!@#'            
        ]);
        $dummyData = [
            
            "description" => "outdoors item"
        ];

        $res = $this->json('POST', 'api/category',$dummyData,[
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
                "password" => 'test123!@#'            
        ]);
        
        $dummyData = [
            "name" => fake()->word(5),
            "description" => fake()->realText(180)
        ];
        
        $this->json('POST', 'api/category', $dummyData, [
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
