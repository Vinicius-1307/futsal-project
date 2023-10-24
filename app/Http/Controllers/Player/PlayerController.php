<?php

namespace App\Http\Controllers\Player;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\CreatePlayerRequest;
use App\Http\Requests\Player\UpdatePlayerRequest;
use App\Models\Player;

class PlayerController extends Controller
{
    public function create(CreatePlayerRequest $request)
    {
        return response()->json(['error' => false, 'message' => 'Jogador criado com sucesso!', 'data' => Player::create($request->validated())], 200);
    }

    public function update(UpdatePlayerRequest $request, $id)
    {
        $player = Player::find($id);
        if (!isset($player)) return ReturnApi::Error("Jogador não encontrado.", 404);

        return response()->json(['error' => false, 'message' => 'Jogador atualizado com sucesso!', 'data' => Player::find($id)->update($request->validated())], 200);
    }

    public function destroy($id)
    {
        $player = Player::find($id);
        if (!isset($player)) return ReturnApi::Error("Jogador não encontrado.", 404);

        return response()->json(['error' => false, 'message' => 'Jogador deletado com sucesso!', 'data' => Player::find($id)->delete()], 200);
    }
}
