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
        $rm = isset($request['remember_me']) ? $request['remember_me'] : false;
        unset($request['remember_me']);
        if (!JWTAuth::attempt($request))

            throw new LoginException();
            
        
        $user = $this->userRepository::getUser(Auth::id())
        ->with([
                'userProfile','userRole','userRole.permissionGroup'
        ])->first();

        return $this->createToken($user,$rm);

    }
    private function createToken($user,$rm){
        
        // 1440
        
        $token = $rm ? auth()->setTTL(null)->login($user) : auth()->setTTL(1440)->login($user);
        $ttl = auth('api')->factory()->getTTL() * 60;
        
        return [

            'user_id' => $user->user_id,
            'email' => $user->email,
            'username' => $user->username,
            'f_name' => $user->userProfile ? $user->userProfile->f_name : 'N/A',
            'l_name' => $user->userProfile ? $user->userProfile->l_name : 'N/A',
            'role' => $user->userRole,
            'token' => $token,
            'expires_in' => $ttl,
            'expires_at' => Carbon::now()->addMinutes(intval($ttl))->toDateTimeString()

        ];

    }
}
