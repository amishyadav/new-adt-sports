<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Teams;
use App\Repositories\TeamsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamsController extends AppBaseController
{
    /**
     * @var TeamsRepository
     */
    private TeamsRepository $teamsRepository;

    /**
     * @param TeamsRepository $teamsRepository
     */
    public function __construct(TeamsRepository $teamsRepository)
    {
        $this->teamsRepository = $teamsRepository;
    }

    public function index(): View|Factory|Application
    {
        return view('teams.index');
    }


    public function store(CreateTeamRequest $request): JsonResponse
    {
        $this->teamsRepository->store($request->all());

        return $this->sendSuccess('Team created successfully.');
    }


    public function edit(Teams $team): JsonResponse
    {
        return $this->sendResponse($team, 'Team successfully retrieved.');
    }


    public function update(UpdateTeamRequest $request, Teams $team): JsonResponse
    {
        $input = $request->all();
        $service = $this->teamsRepository->update($input, $team->id);

        return $this->sendResponse($service, 'Team Updated successfully.');

    }

    public function destroy(Teams $team): JsonResponse
    {
//        if ($team->league_count > 0){
//            return $this->sendError('Category cannot be deleted.');
//
//        }

        $team->delete();

        return $this->sendSuccess('Team deleted successfully.');
    }

    public function changeStatus(Teams $team): JsonResponse
    {
        $team->update(['status' => $team->status == 0 ? 1 : 0]);

        return $this->sendResponse($team, 'Team Status Update Successfully');
    }
}
