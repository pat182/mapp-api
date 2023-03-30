<?php

namespace App\Http\Middleware;

// use Carbon\Carbon;
use Closure;
use JWTAuth;
use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JWTMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['message' => 'Token is Invalid'], 401);
            } elseif ($e instanceof TokenExpiredException) {
                return response()->json(['message' => 'Token has Expired'], 401);
            } else {
                return response()->json(['message' => $e->getMessage()]);
            }
        }
        return $next($request);
    }

}
