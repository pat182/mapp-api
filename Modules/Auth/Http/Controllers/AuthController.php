<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Services\AuthService;
use Modules\User\Transformer\LoginResource;
use Modules\User\Entities\Repositories\UserRepository;
use Modules\Auth\Http\Requests\{RegisterUserRequest,LogInRequest};

class AuthController extends Controller
{
    public function __construct(UserRepository $userRepo, AuthService $authService){

        $this->userRepo = $userRepo;
        $this->authService = $authService;

    }

    public function register(RegisterUserRequest $req){

        return new LoginResource($this->userRepo->createUser($req));
        
    }
    public function login(LogInRequest $req){
        
        return new LoginResource( $this->authService->login($req->payload()) );
        // return response()->json( ["data" => $this->authService->login($req->payload())] );

    }

    public function refresh()
    {
        return auth()->refresh();
    }

    public function logout(){

        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);

    }
    
}
