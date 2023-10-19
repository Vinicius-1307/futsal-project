<?php

namespace App\Http\Requests\Match;

use App\Exceptions\ApiException;
use App\Rules\Matches\CreateMatchRule;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateMatchRequest extends FormRequest
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
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'teamA_id' => ['exists:teams,id', new CreateMatchRule],
            'teamB_id' => ['exists:teams,id', new CreateMatchRule],
        ];
    }

    public function attributes(): array
    {
        return [
            'start_time' => 'Hora inicial',
            'end_time' => 'Hora final',
            'teamA_id' => 'Time A',
            'teamB_id' => 'Time B',
        ];
    }

    public function messages(): array
    {
        return [
            'start_time.required' => 'O campo start_time é obrigatório.',
            'start_time.date' => 'O campo start_time é uma data.',
            'end_time.required' => 'O campo end_time é obrigatório.',
            'teamA_id.required' => 'O campo time A é obrigatório.',
            'teamA_id.exists' => 'O time A precisa existir.',
            'teamB_id.required' => 'O campo time B é obrigatório.',
            'teamB_id.exists' => 'O time B precisa existir.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'start_time' => Carbon::parse($this->input('start_time'))->format('Y-m-d H:i:s'),
            'end_time' => Carbon::parse($this->input('end_time'))->format('Y-m-d H:i:s')
        ]);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiException($validator->errors()->first());
    }
}
