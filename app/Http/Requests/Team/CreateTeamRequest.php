<?php

namespace App\Http\Requests\Team;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateTeamRequest extends FormRequest
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
            'name' => [
                'string',
                'required',
                'unique:teams,name'
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nome do time'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é um campo obrigatorio',
            'name.string' => 'Nome deve ser um campo do tipo string',
            'name.unique' => 'O nome do time não pode se repetir.'
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiException($validator->errors()->first());
    }
}
