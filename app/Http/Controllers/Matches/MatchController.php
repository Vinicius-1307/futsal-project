<?php

namespace App\Http\Controllers\Matches;

use App\Http\Controllers\Controller;
use App\Http\Requests\Match\CreateMatchRequest;
use App\Models\Matches;

class MatchController extends Controller
{
    public function create(CreateMatchRequest $request)
    {
        return response()->json(['error' => false, 'message' => 'Partida criada com sucesso!', 'data' => Matches::create($request->validated())], 200);
    }
}
