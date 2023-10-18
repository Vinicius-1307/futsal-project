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
            'name' => 'string|required',
            'shirt_number' => ['integer', new ShirtRule(request()->input('team_id'))],
            'team_id' => 'integer'

        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Nome',
            'shirt_number' => 'Número da camisa',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Nome deve ser uma string.',
            'name.required' => 'O campo nome é obrigatório.',
            'shirt_number.integer' => 'O número da camisa deve ser um inteiro.',
            'team_id.integer' => 'O ID do time deve ser um inteiro.',
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiException($validator->errors()->first());
    }
}
