<?php

namespace App\Http\Controllers\Matches;

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
        $data = $request->all();

        $match = Matches::find($id);

        $match->update([
            'goalsTeamA' => $data['goalsTeamA'],
            'goalsTeamB' => $data['goalsTeamB']
        ]);

        // $goalsTeamA = $request->goalsTeamA;
        // $goalsTeamB = $request->goalsTeamB;

        return response()->json(['error' => false, 'message' => 'Partida atualizada com sucesso!', 'data' => $match], 200);
    }
}
