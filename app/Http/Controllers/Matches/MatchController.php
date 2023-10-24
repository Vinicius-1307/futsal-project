<?php

namespace App\Http\Controllers\Matches;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Match\CreateMatchRequest;
use App\Http\Requests\Match\DeleteMatchRequest;
use App\Http\Requests\Match\UpdateMatchRequest;
use App\Models\Matches;

class MatchController extends Controller
{
    public function create(CreateMatchRequest $request)
    {
        return ReturnApi::Success('Time criado com sucesso!', Matches::create($request->validated()), 200);
    }

    public function update(UpdateMatchRequest $request)
    {
        return ReturnApi::Success('Jogador atualizado com sucesso!', Matches::find($request->validated()['id'])->update($request->validated()));
    }

    public function destroy(DeleteMatchRequest $request)
    {
        return ReturnApi::Success('Jogador atualizado com sucesso!', Matches::find($request->validated()['id'])->delete());
    }
}
