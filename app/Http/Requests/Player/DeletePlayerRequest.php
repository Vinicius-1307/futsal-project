<?php

namespace App\Http\Requests\Player;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DeletePlayerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
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
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'ID é um campo obrigatorio.',
            'id.integer' => 'ID deve ser um campo do tipo inteiro.',
            'id.exists' => 'Jogador não encontrado.'
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
