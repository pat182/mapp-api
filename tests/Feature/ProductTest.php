<?php

namespace Tests\Feature;

use Tests\TestCase;
use Modules\Auth\Services\AuthService;
use Modules\User\Entities\Repositories\UserRepository;
use Modules\Products\Entities\Repositories\CategoryRepository;

class ProductTest extends TestCase
{
    public function testProductValidation()
    {
        // $user = UserRepository::newF()->make();

        $cred = (new AuthService(new UserRepository()))->login([
                "username" => 'pat182',
                "password" => 'test123!@#'            
        ]);
        $dummyData = [
            
            "description" => fake()->realText(180)
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
                "password" => 'test123!@#'            
        ]);
        
        $dummyData = [

            "category" => CategoryRepository::inRandomOrder()->first()->id,
            "name" => fake()->word(5),
            "description" => fake()->realText(180)
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
