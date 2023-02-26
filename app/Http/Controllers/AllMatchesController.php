<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAllMatchRequest;
use App\Http\Requests\UpdateAllMatchRequest;
use App\Models\AllMatch;
use App\Models\League;
use App\Repositories\AllMatchRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AllMatchesController extends AppBaseController
{
    private AllMatchRepository $allMatchRepo;
    /**
     * @param AllMatchRepository $allMatchRepo
     */
    public function __construct(AllMatchRepository $allMatchRepo)
    {
        $this->allMatchRepo = $allMatchRepo;
    }
    
    public function index(): Factory|View|Application
    {
        $league = League::where('status', 1)->pluck('name', 'id')->toArray();

        return view('manage_matches.all_matches.index', compact('league'));
    }

    public function store(CreateAllMatchRequest $request): JsonResponse
    {
        $this->allMatchRepo->create($request->all());

        return $this->sendSuccess('Match added successfully.');
    }

    /**
     * @param AllMatch $allMatch
     *
     *
     * @return mixed
     */
    public function edit(AllMatch $allMatch): JsonResponse
    {
        return $this->sendResponse($allMatch, 'Match successfully retrieved');
    }


    public function update(UpdateAllMatchRequest $request, AllMatch $allMatch): JsonResponse
    {
        $match = $this->allMatchRepo->update($request->all(), $allMatch->id);

        return $this->sendSuccess('Match Update successfully.');
    }
    
    /**
     * @param Request $request
     *
     *
     * @return JsonResponse
     */
    public function changeStatus(Request $request): JsonResponse
    {
        $match = AllMatch::findOrFail($request->id);
        $match->update(['status' => !$match->status]);
        
        return $this->sendResponse($match, 'Match Status Update Successfully');
    }

}
