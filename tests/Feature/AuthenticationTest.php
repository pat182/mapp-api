<?php

namespace Tests\Feature;

use Modules\User\Entities\Repositories\UserRepository;
// use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    
    public function testMustEnterUsernamePasswordAndRole()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'username', 'password']);
    }
    public function testFailLogin(){

        $user = [
            "username" => "test182",
            'password' => bcrypt('sample123'),
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
            'password' => 'test123!@#',
        ];
        
        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                   'user_id',
                   'email',
                   'username',
                   'f_name',
                   'l_name',
                   'token',
                   'expires_in',
                   'expires_at',
               ]
            ]);

        $this->assertAuthenticated();
    }
    public function testMustInputRequiredDataOnRegister(){

        $this->json('POST', 'api/register',['Accept' => 'application/json'])
            ->assertStatus(422);

    }


}
