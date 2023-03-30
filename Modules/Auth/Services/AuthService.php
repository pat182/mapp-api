<?php

namespace Modules\Auth\Services;

use JWTAuth;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\Repositories\UserRepository;
use Modules\Auth\Exceptions\LoginException;


class AuthService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($request)
    {

        if (!JWTAuth::attempt($request))

            throw new LoginException();
            
       
        $user = $this->userRepository::getUser(Auth::id())->first();
        return $this->createToken($user);

    }
    private function createToken($user){
        $token = auth()->setTTL(30)->login($user);
        // Socket::BrodCast(['username' => $user->username,'action' => 'login']);
        $ttl = auth('api')->factory()->getTTL() * 60;
        return [
            'user_id' => $user->user_id,
            'email' => $user->email,
            'user' => $user->username,
            'token' => $token,
            'expires_in' => $ttl,
            'expires_at' => Carbon::now()->addMinutes(intval($ttl))->toDateTimeString()
        ];

    }
}
