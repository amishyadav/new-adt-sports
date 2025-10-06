<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamMatchRequest;
use App\Http\Requests\UpdateTeamMatchRequest;
use App\Models\TeamMatch;
use App\Models\Teams;
use App\Repositories\TeamMatchRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamMatchController extends AppBaseController
{
    /**
     * @var TeamMatchRepository
     */
    private TeamMatchRepository $teamMatchRepository;

    /**
     * @param TeamMatchRepository $teamMatchRepository
     */
    public function __construct(TeamMatchRepository $teamMatchRepository)
    {
        $this->teamMatchRepository = $teamMatchRepository;
    }

    public function index(TeamMatch $teamMatch): View|Factory|Application
    {
        $teams = Teams::pluck('name')->toArray();

        return view('team_match.index')->with('teams', $teams);
    }


    public function store(CreateTeamMatchRequest $request): JsonResponse
    {
        $this->teamMatchRepository->store($request->all());

        return $this->sendSuccess('Team Match created successfully.');
    }


    public function edit(TeamMatch $teamMatch): JsonResponse
    {
        return $this->sendResponse($teamMatch, 'Team Match successfully retrieved.');
    }


    public function update(UpdateTeamMatchRequest $request, TeamMatch $teamMatch): JsonResponse
    {
        $input = $request->all();
        $data = $this->teamMatchRepository->update($input, $teamMatch->id);

        return $this->sendResponse($data, 'Team Match Updated successfully.');

    }

    public function destroy(TeamMatch $teamMatch): JsonResponse
    {
        $teamMatch->delete();

        return $this->sendSuccess('Team Match deleted successfully.');
    }
}
