<?php

namespace App\Rules;

use App\Models\Player;
use Illuminate\Contracts\Validation\Rule;

class ShirtRule implements Rule
{
    private $team_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($team_id)
    {
        $this->team_id = $team_id;
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
        $numberInUse = Player::where('shirt_number', $value)
            ->where('team_id', request()->input('team_id'))
            ->first();

        return !$numberInUse;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esse número já está em uso.';
    }
}
