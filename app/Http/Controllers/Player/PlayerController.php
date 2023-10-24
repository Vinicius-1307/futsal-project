<?php

namespace App\Http\Controllers\Player;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\CreatePlayerRequest;
use App\Http\Requests\Player\DeletePlayerRequest;
use App\Http\Requests\Player\UpdatePlayerRequest;
use App\Models\Player;

class PlayerController extends Controller
{
    public function create(CreatePlayerRequest $request)
    {
        return ReturnApi::Success('Time criado com sucesso!', Player::create($request->validated()), 200);
    }

    public function update(UpdatePlayerRequest $request)
    {
        return ReturnApi::Success('Jogador atualizado com sucesso!', Player::find($request->validated()['id'])->update());
    }

    public function destroy(DeletePlayerRequest $request)
    {
        return ReturnApi::Success('Time deletado com sucesso!', Player::find($request->validated()['id'])->delete());
    }
}
