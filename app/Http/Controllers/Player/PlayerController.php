<?php

namespace App\Http\Controllers\Player;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\CreatePlayerRequest;
use App\Http\Requests\Player\UpdatePlayerRequest;
use App\Models\Player;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function create(CreatePlayerRequest $request)
    {
        $data = $request->all();
        try {
            Player::create([
                'name' => $data['name'],
                'shirt_number' => $data['shirt_number'],
                'team_id' => $data['team_id']
            ]);
            return response()->json(['error' => false, 'message' => 'Jogador cadastrado com sucesso!', 'data' => $data], 200);
        } catch (Exception $err) {
            return ['error' => true, 'message' => $err->getMessage()];
        }
    }

    public function update(UpdatePlayerRequest $request, $id)
    {
        $data = $request->all();

        try {
            $player = Player::find($id);
            if (!isset($player)) return ReturnApi::Error('Esse jogador não está cadastrado.', 404);

            $player->update([
                'name' => $data['name'],
                'shirt_number' => $data['shirt_number'],
                'team_id' => $data['team_id']
            ]);

            return ReturnApi::Success("Dados do jogador atualizados com sucesso.", 200);
        } catch (\Exception $error) {
            return ReturnApi::Error('Erro ao atualizar o jogador.', $error->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        return response()->json(['error' => false, 'message' => 'Jogador deletado com sucesso!', 'data' => Player::find($id)->delete()], 200);
    }
}
