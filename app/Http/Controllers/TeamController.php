<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddPlayerRequest;
use App\Http\Requests\CreateTeamRequest;
use App\Models\RegisteredPlayer;
use App\Models\team;
use App\Models\TeamPlayer;
use App\Models\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class TeamController extends Controller
{
    public function store(CreateTeamRequest $request)
    {
        $userID = getLogInUserId();
        $input = $request->all();
        $input['user_id'] = $userID;

        $teamExists = Team::where('user_id',$userID)->first();

        $player = RegisteredPlayer::where('user_id',$userID)->first();

        if (empty($player)){
            RegisteredPlayer::create([
                'user_id' => $userID,
                'status'  => RegisteredPlayer::ACTIVE
            ]);
        }

        if ($teamExists){
            $teamExists->update(['name' => $input['name']]);

            if (isset($input['team_logo']) && ! empty('team_logo')) {
                $teamExists->clearMediaCollection(Team::TEAM_LOGO);
                $teamExists->media()->delete();
                $teamExists->addMedia($input['team_logo'])->toMediaCollection(Team::TEAM_LOGO, config('app.media_disc'));
            }
        }
        else {
           $team = Team::create($input);

            if (isset($input['team_logo']) && !empty('team_logo')) {
                $team->addMedia($input['team_logo'])->toMediaCollection(Team::TEAM_LOGO, config('app.media_disc'));
            }
        }

        Flash::success('Team successfully registered to ADT Sports');

        return redirect(route('front.player.profile'));
    }

    public function addPlayer(CreateAddPlayerRequest $request)
    {
        if (empty(getLogInUser()->team)){
            Flash::error('Team Not Found.');

            return redirect(route('front.player.profile'));
        }

        $playerID = strtoupper($request->get('unique_code'));

        $user = User::where('unique_code',$playerID)->first();

        if ($user){
            $playerExists = TeamPlayer::where('user_id',$user->id)->exists();
            if ($playerExists){
                Flash::error('Player already exists.');
                return redirect(route('front.player.profile'));
            }

            TeamPlayer::create([
                'team_id' => getLogInUser()->team->id,
                'user_id' => $user->id,
                'add_by_user_id' => getLogInUserId(),
            ]);

            Flash::success('Player successfully added to your team.');
        }
        else {
            Flash::error('Player not found, Please check Player ID');
        }

        return redirect(route('front.player.profile'));
    }
}
