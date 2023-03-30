<?php

namespace Tests\Feature;

use Modules\User\Entities\Repositories\UserRepository;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    

    public function testMustEnterUsernameAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The username field is required. (and 1 more error)",
                "errors" => [
                    'username' => ["The username field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }
    public function testFailLogin(){

        $user = [
            "username" => "test182",
            'password' => bcrypt('sample123')
        ];
        $this->json('POST', 'api/login', $user, ['Accept' => 'application/json'])
        ->assertStatus(400)
        ->assertJson([
            "code" => 400,
            "error_code" => '--',
            "message" => "Invalid Credentials"
        ]);

    }
    public function testSuccessfulLogin()
    {

        $loginData = [
            'username' => 'pat182',
            'password' => 'test182!@#'
        ];
        // $this->assertJsonStructure
        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                   'user_id',
                   'email',
                   'user',
                   'token',
                   'expires_in',
                   'expires_at',
               ]
            ]);

        $this->assertAuthenticated();
    }
    public function testMustInputRequiredDataOnRegister(){
        $this->json('POST', 'api/register')
            ->assertStatus(422);
    }
    public function testLogout(){
        $this->json('POST', 'api/logout')
            ->assertStatus(200);
    }
}
