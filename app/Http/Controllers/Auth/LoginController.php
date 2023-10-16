<?php

namespace App\Http\Controllers\Auth;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $validators = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $messages = [
            'email.required' => 'E-mail não inserido',
            'password.required' => 'Senha não inserida',
            'password.min' => 'Insira uma senha de no mínimo 6 caracteres'
        ];

        $isValidated = \Illuminate\Support\Facades\Validator::make($credentials, $validators, $messages);

        if ($isValidated->fails()) {
            return ReturnApi::messageReturn(true, $isValidated->errors()->first(), null, null, null, 400);
        }

        if (!$token = Auth::attempt($credentials)) {
            return ReturnApi::Error("E-mail ou senha incorretos", 401);
        }

        $user = Auth::user();

        return ReturnApi::Success("Usuário autenticado com sucesso", array('user' => $user, "token" => $token), 200);
    }
}
