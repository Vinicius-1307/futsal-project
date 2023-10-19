<?php

namespace App\Rules\Matches;

use App\Models\Team;
use Illuminate\Contracts\Validation\Rule;

class CreateMatchRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Team::find($value)->players->count() >= 5;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cada time deve ter no mínimo 5 jogadores para participar de uma partida.';
    }
}
