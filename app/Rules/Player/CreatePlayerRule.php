<?php

namespace App\Rules\Player;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Contracts\Validation\Rule;

class CreatePlayerRule implements Rule
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
        $verifyTeamAlreadyExist = Team::where('team_id', $value)
            ->where('team_id', request()->input('team_id'));

        return $verifyTeamAlreadyExist;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esse time não existe.';
    }
}
