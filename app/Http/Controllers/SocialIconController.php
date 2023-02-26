<?php

namespace App\Http\Controllers;

use App\Models\SocialIcon;
use App\Repositories\SocialIconRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Console\Application;

class SocialIconController extends AppBaseController
{

    /**
     * @param SocialIconRepository $socialIconRepository
     */
    public function __construct(SocialIconRepository $socialIconRepository)
    {
        $this->socialIconRepo = $socialIconRepository;
    }

    public function index(): Factory|View|Application
    {
        return view('social_icon.index');
    }

    public function store(Request $request): JsonResponse
    {
        $this->socialIconRepo->create($request->all());

        return $this->sendSuccess('Social Icon create successfully.');
    }
    
    public function edit(SocialIcon $socialIcon): JsonResponse
    {
        return $this->sendResponse($socialIcon, 'Social Icon successfully retrieved.');
    }


    public function update(Request $request, $id): JsonResponse
    {
        $social_icon = $this->socialIconRepo->update($request->all(), $id);

        return $this->sendSuccess('Social Icon Update successfully.');
    }


    public function destroy(SocialIcon $socialIcon): JsonResponse
    {
        $socialIcon->delete();

        return $this->sendSuccess('Social Icon deleted successfully.');
    }
}
