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
        
        return $this->authService->login($req->payload());

    }
    
}
