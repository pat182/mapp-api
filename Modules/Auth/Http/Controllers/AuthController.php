<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Transformer\LoginResource;
use Modules\Auth\Http\Requests\{RegisterUserRequest,LogInRequest};
use Modules\User\Entities\Repositories\UserRepository;
use Modules\Role\Entities\Repositories\RoleRepository;

class AuthController extends Controller
{
    public function __construct(UserRepository $userRepo, AuthService $authService){

        $this->userRepo = $userRepo;
        $this->authService = $authService;

    }

    public function register(RegisterUserRequest $req){
        
        // return new LoginResource($this->userRepo->createUser($req));
        return response()->json(['message' => $this->userRepo->createUser($req)],200);
        
    }
    public function login(LogInRequest $req){

        return new LoginResource( $this->authService->login($req->payload()) );

    }

    public function refresh()
    {
        return response()->json([
            "token" => auth()->refresh()
        ]);
    }

    public function logout(){

        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);

    }

    public function getRoles(){

        return response()->json([

            "data" => RoleRepository::all()

        ]);

    }
    
}
