<?php

namespace App\Http\Controllers\Teams;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
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
}
