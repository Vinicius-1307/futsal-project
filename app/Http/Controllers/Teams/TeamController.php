<?php

namespace App\Http\Controllers\Teams;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use App\Http\Requests\Team\DeleteTeamRequest;
use App\Http\Requests\Team\EditTeamRequest;
use App\Models\Team;

class TeamController extends Controller
{
    public function create(CreateTeamRequest $request)
    {
        return ReturnApi::Success('Time criado com sucesso!', Team::create($request->validated()), 200);
    }

    public function edit(EditTeamRequest $request)
    {
        return ReturnApi::Success('Time atualizado com sucesso!', Team::find($request->validated()['id'])->update());
    }

    public function list()
    {
        return response()->json(['error' => false, 'message' => 'Times com seus jogadores', 'data' => Team::with('players')->get()], 200);
    }

    public function listOrderBy()
    {
        return response()->json(['error' => false, 'message' => 'Tabela dos times:', 'data' => Team::orderBy('points', 'desc')->get()], 200);
    }

    public function destroy(DeleteTeamRequest $request)
    {
        return ReturnApi::Success('Time deletado com sucesso!', Team::find($request->validated()['id'])->delete());
    }
}
