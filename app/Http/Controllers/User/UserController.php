<?php

namespace App\Http\Controllers\User;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();

        $verifyEmailAlreadyExist = User::where('email', $data['email'])->first();

        if ($verifyEmailAlreadyExist) return ReturnApi::Error('Esse e-mail já existe.', 400);

        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);
            return ReturnApi::Success('Usuário criado com sucesso.', $data);
        } catch (\Throwable $th) {
            return ReturnApi::Error('Erro ao criar usuário.', $th->getMessage(), 400);
        }
    }
}
