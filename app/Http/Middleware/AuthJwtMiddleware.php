<?php

namespace App\Http\Middleware;

use App\Builder\ReturnApi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $credentials = $request->only(['email', 'password']);

        $validators = [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ];

        $messages = [
            'email.required' => 'Email não inserido',
            'password.required' => 'Senha não inserida',
            'password.min' => 'Insira uma senha de no mínimo 6 caracteres'
        ];

        $isValidated = \Illuminate\Support\Facades\Validator::make($credentials, $validators, $messages);

        if ($isValidated->fails()) {
            return ReturnApi::messageReturn(true, $isValidated->errors()->first(), null, null, null, 400);
        }

        if (!$token = Auth::attempt($credentials)) {
            return ReturnApi::messageReturn(true, "Email ou senha incorretos", 'wrong credentials', null, null, 401);
        }

        $user = Auth::user();

        return ReturnApi::messageReturn(false, null, null, null, array('user' => $user, 'token' => $token), 200);
    }
}
