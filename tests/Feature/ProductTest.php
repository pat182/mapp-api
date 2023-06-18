<?php

namespace Tests\Feature;

use Tests\TestCase;
use Modules\Auth\Services\AuthService;
use Modules\User\Entities\Repositories\UserRepository;


class ProductTest extends TestCase
{
    public function testProductValidation()
    {
        // $user = UserRepository::newF()->make();

        $cred = (new AuthService(new UserRepository()))->login([
                "username" => 'pat182',
                "password" => 'test182!@#'            
        ]);
        $dummyData = [
            
            "description" => "outdoors item"
        ];

        $res = $this->json('POST', 'api/product',$dummyData,[
            'Accept' => 'application/json',
            'Authorization' => "Bearer {$cred['token']}"
        ]);
        $res->assertStatus(422);
    }
    public function testCreateNewProductSuccess()
    {

        // $user = UserRepository::newF()->make();

        $cred = (new AuthService(new UserRepository()))->login([
                "username" => 'pat182',
                "password" => 'test182!@#'            
        ]);
        
        $dummyData = [

            "category" => 51,
            "name" => "pokeball",
            "description" => "item for catching pokemon"
        ];
        
        $this->json('POST', 'api/product', $dummyData, [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$cred['token']}"
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
                "data" => [
                    "name",
                    "description",
                    "category",
                    "updated_at",
                    "created_at",
                    "id"
                ]
            ]);

    }


}
