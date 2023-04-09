<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegisteredPlayerRequest;
use App\Http\Requests\UpdateRegisteredPlayerRequest;
use App\Models\RegisteredPlayer;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisteredPlayerController extends AppBaseController
{

    public function index(): View|Factory|Application
    {
        ini_set('max_execution_time', 0);
        return view('registered_players.index');
    }


    public function store(CreateRegisteredPlayerRequest $request): JsonResponse
    {
        ini_set('max_execution_time', 0);
        $input = $request->all();
        $status = isset($input['status']) ? 1 : 0;

        $playerID = strtoupper($request->get('unique_code'));

        $user = User::where('unique_code',$playerID)->first();

        if ($user){
            $playerExists = RegisteredPlayer::where('user_id',$user->id)->first();
            if ($playerExists){
                return $this->sendError('Player already exists.');
            }

            RegisteredPlayer::create([
                'user_id' => $user->id,
                'status'  => $status
            ]);
        } else {
            return $this->sendError('Player not found, please check Player ID.');
        }

        return $this->sendSuccess('Player Registered successfully.');
    }


    public function edit(RegisteredPlayer $registeredPlayer): JsonResponse
    {
        return $this->sendResponse($registeredPlayer, 'Player successfully retrieved.');
    }


    public function update(UpdateRegisteredPlayerRequest $request, RegisteredPlayer $registeredPlayer): JsonResponse
    {
        $input = $request->all();
        $status = isset($input['status']) ? 1 : 0;

        $playerID = strtoupper($request->get('unique_code'));

        $user = User::where('unique_code',$playerID)->first();

        if ($user){
            $playerExists = RegisteredPlayer::where('user_id',$user->id)->first();
            if ($playerExists){
                return $this->sendError('Player already exists.');
            }

            $player = RegisteredPlayer::findOrFail($input['id']);
            $player->update([
                'user_id' => $user->id,
                'status'  => $status
            ]);
        }
        else {
            return $this->sendError('Player not found, please check Player ID.');
        }



        return $this->sendResponse($player, 'Player Update successfully.');

    }

    public function destroy(RegisteredPlayer $registeredPlayer): JsonResponse
    {
        $registeredPlayer->delete();

        return $this->sendSuccess('Player deleted successfully.');
    }

    public function changeStatus(RegisteredPlayer $registeredPlayer): JsonResponse
    {
        $registeredPlayer->update(['status' => $registeredPlayer->status == 0 ? 1 : 0]);

        return $this->sendResponse($registeredPlayer, 'Status Update Successfully');
    }
}
