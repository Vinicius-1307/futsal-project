<?php

namespace App\Http\Controllers\Teams;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\EditTeamRequest;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();

        $verifyName = Team::where('name', $data['name'])->first();

        if ($verifyName) return ReturnApi::Error('Esse nome de time já existe!', 400);

        try {
            Team::create([
                'name' => $data['name']
            ]);
            return ReturnApi::Success('Time cadastrado com sucesso!', $data, 200);
        } catch (Exception $err) {
            return response()->json(['error' => true, 'message' => $err->getMessage()]);
        }
    }

    public function edit(EditTeamRequest $request, $id)
    {
        $data = $request->all();

        try {
            $team = Team::find($id);
            if (!isset($team)) return ReturnApi::Error("Time não encontrado", 404);

            $verifyName = Team::where('name', $data['name'])->first();
            if ($verifyName) return ReturnApi::Error('Esse nome de time já existe!', 400);

            $oldTeam = $team;

            foreach ($team->toArray() as $key => $value) $team[$key] = array_key_exists($key, $team->toArray()) ? $value : $data[$key];

            $team->update($data);

            return ReturnApi::Success("Nome do time atualizado com sucesso!", 200);
        } catch (\Exception $error) {
            $oldTeam->update();
            return ReturnApi::Error('Erro ao atualizar o time.', $error->getMessage(), 500);
        }
    }

    public function list()
    {
        return (['error' => false, 'teams' => Team::with('players')->get()]);
    }
}
