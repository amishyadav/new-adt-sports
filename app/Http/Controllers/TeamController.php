<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddPlayerRequest;
use App\Http\Requests\CreateTeamRequest;
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

        $teamExists = team::where('user_id',$userID)->first();

        if ($teamExists){
            $teamExists->update(['name' => $input['name']]);
        }
        else {
            team::create($input);
        }

        Flash::success('Team successfully registered to ADT Sports');

        return redirect(route('front.player.profile'));
    }

    public function addPlayer(CreateAddPlayerRequest $request)
    {
        $playerID = strtoupper($request->get('unique_code'));

        $user = User::where('unique_code',$playerID)->first();

        if (empty(getLogInUser()->team)){
            Flash::error('Team Not Found.');

            return redirect(route('front.player.profile'));
        }

        if ($user){
            TeamPlayer::create([
                'team_id' => getLogInUser()->team->id,
                'user_id' => $user->id,
                'add_by_user_id' => getLogInUserId(),
            ]);
        }
        else {
            Flash::error('Player not found, Please check Player ID');
        }

        Flash::success('Player successfully added to your team.');

        return redirect(route('front.player.profile'));
    }
}
