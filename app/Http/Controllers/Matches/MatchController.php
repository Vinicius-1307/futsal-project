<?php

namespace App\Http\Controllers\Matches;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Match\CreateMatchRequest;
use App\Http\Requests\Match\UpdateMatchRequest;
use App\Models\Matches;

class MatchController extends Controller
{
    public function create(CreateMatchRequest $request)
    {
        return response()->json(['error' => false, 'message' => 'Partida criada com sucesso!', 'data' => Matches::create($request->validated())], 200);
    }

    public function update(UpdateMatchRequest $request, $id)
    {
        $match = Matches::find($id);
        if (!isset($match)) return ReturnApi::Error("Partida não encontrada.", 404);

        return response()->json(['error' => false, 'message' => 'Partida atualizada com sucesso!', 'data' => Matches::find($id)->update($request->validated())], 200);
    }

    public function destroy($id)
    {
        $match = Matches::find($id);
        if (!isset($match)) return ReturnApi::Error("Partida não encontrada.", 404);

        return response()->json(['error' => false, 'message' => 'Partida deletada com sucesso!', 'data' => Matches::find($id)->delete()], 200);
    }
}
