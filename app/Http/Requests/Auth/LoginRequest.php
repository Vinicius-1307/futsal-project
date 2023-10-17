<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'string',
                'email',
                'required',
                'exists:users,email'
            ],
            'password' => [
                'string',
                'required',
                'min:8'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Senha',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-mail é um campo obrigatorio',
            'email.email' => 'E-mail esta em um formato invalido',
            'email.string' => 'E-mail deve ser um campo do tipo string',
            'email.exists' => 'Usuário ou senha incorretos',
            'password.required' => 'Senha é um campo obrigatorio',
            'password.string' => 'Senha deve ser um dado no formato string',
            'password.min' => 'Senha deve possuir no minimo 8 caracteres'
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiException($validator->errors()->first());
    }
}
