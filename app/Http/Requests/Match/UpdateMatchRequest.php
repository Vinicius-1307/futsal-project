<?php

namespace App\Http\Requests\Match;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMatchRequest extends FormRequest
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
            'goalsTeamA' => 'required|integer|min:0',
            'goalsTeamB' => 'required|integer|min:0',
        ];
    }
    public function attributes(): array
    {
        return [
            'goalsTeamA' => 'Gols time A',
            'goalsTeamB' => 'Gols time A',
        ];
    }

    public function messages(): array
    {
        return [
            'goalsTeamA.required' => 'O campo goalsTeamA é obrigatório.',
            'goalsTeamA.integer' => 'O campo goalsTeamA é um inteiro.',
            'goalsTeamA.min' => 'O campo goalsTeamA deve ter no minimo 0.',
            'goalsTeamB.required' => 'O campo goalsTeamB é obrigatório.',
            'goalsTeamB.integer' => 'O campo goalsTeamB é um inteiro.',
            'goalsTeamB.min' => 'O campo goalsTeamB deve ter no minimo 0.',
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiException($validator->errors()->first());
    }
}
