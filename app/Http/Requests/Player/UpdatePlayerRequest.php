<?php

namespace App\Http\Requests\Player;

use App\Exceptions\ApiException;
use App\Rules\Shirt\ShirtRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
            'id' => [
                'required',
                'integer',
                'exists:players,id'
            ],
            'name' => [
                'string',
                'required'
            ],
            'shirt_number' => [
                'integer',
                new ShirtRule(request()->input('team_id'))
            ],
            'team_id' => [
                'required',
                'integer',
                'exists:teams,id'
            ]

        ];
    }
    public function attributes(): array
    {
        return [
            'id' => 'ID do jogador',
            'name' => 'Nome',
            'shirt_number' => 'Número da camisa',
            'team_id' => 'ID do time'
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Nome deve ser uma string.',
            'name.required' => 'O campo nome é obrigatório.',
            'shirt_number.integer' => 'O número da camisa deve ser um inteiro.',
            'team_id.integer' => 'O ID do time deve ser um inteiro.',
            'id.required' => 'ID é um campo obrigatorio.',
            'id.integer' => 'ID deve ser um campo do tipo inteiro.',
            'id.exists' => 'Jogador não encontrado.',
            'team_id.required' => 'ID é um campo obrigatorio.',
            'team_id.integer' => 'ID deve ser um campo do tipo inteiro.',
            'team_id.exists' => 'Time não encontrado.'
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiException($validator->errors()->first());
    }
}
