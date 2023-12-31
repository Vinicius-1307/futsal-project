<?php

namespace App\Http\Requests\Team;

use App\Exceptions\ApiException;
use App\Rules\Team\UpdateTeamRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EditTeamRequest extends FormRequest
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
                'exists:teams,id'
            ],
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
            'id' => 'ID do time',
            'name' => 'Nome do time'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'ID é um campo obrigatorio.',
            'id.integer' => 'ID deve ser um campo do tipo inteiro.',
            'id.exists' => 'Time não encontrado.',
            'name.required' => 'Nome é um campo obrigatorio.',
            'name.string' => 'Nome deve ser um campo do tipo string.',
            'name.unique' => 'O nome do time não pode se repetir.'
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
