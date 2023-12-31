<?php

namespace App\Http\Middleware;

use App\Builder\ReturnApi;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class AuthJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = FacadesJWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWtAuth\Exceptions\TokenInvalidException) {
                return ReturnApi::messageReturn(true, "Faça login para acessar o sistema", "Token is invalid", $e->getMessage(), null, 401);
            } else if ($e instanceof \Tymon\JWtAuth\Exceptions\TokenExpiredException) {
                return ReturnApi::messageReturn(true, "Login expirado, saia e entre novamente", "Token expired", $e->getMessage(), null, 401);
            } else {
                return ReturnApi::messageReturn(true, "Token de autorização não informado", "Auth token not found", $e->getMessage(), null, 401);
            }
        }
        return $next($request);
    }
}
