<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use App\Http\Requests\Team\EditTeamRequest;
use App\Models\Team;

class TeamController extends Controller
{
    public function create(CreateTeamRequest $request)
    {
        return response()->json(['error' => false, 'message' => 'Time criado com sucesso!', 'data' => Team::create($request->validated())], 200);
    }

    public function edit(EditTeamRequest $request, $id)
    {
        return response()->json(['error' => false, 'message' => 'Time atualizado com sucesso!', 'data' => Team::find($id)->update($request->validated())], 200);
    }

    public function list()
    {
        return response()->json(['error' => false, 'message' => 'Times com seus jogadores', 'data' => Team::with('players')->get()], 200);
    }

    public function listOrderBy()
    {
        return response()->json(['error' => false, 'message' => 'Tabela dos times:', 'data' => Team::orderBy('points', 'desc')->get()], 200);
    }

    public function destroy($id)
    {
        return response()->json(['error' => false, 'message' => 'Time deletado com sucesso!', 'data' => Team::find($id)->delete()], 200);
    }
}
