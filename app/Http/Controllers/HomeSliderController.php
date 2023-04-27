<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use App\Repositories\HomeSliderRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class HomeSliderController extends AppBaseController
{
    /**
     * @param HomeSliderRepository $homeSliderRepository
     */
    public function __construct(HomeSliderRepository $homeSliderRepository)
    {
        $this->homeSliderRepository = $homeSliderRepository;
    }

    public function index()
    {
        return view('cms.home_slider.index');
    }


    public function create()
    {
        return view('cms.home_slider.create');
    }


    public function store(Request $request)
    {
        $this->homeSliderRepository->store($request->all());

        Flash::success(__('Home Slider created successfully.'));

        return redirect(route('home-slider.index'));
    }

    public function edit(HomeSlider $homeSlider)
    {
        return view('cms.home_slider.edit', compact('homeSlider'));
    }

    public function update(Request $request,HomeSlider $homeSlider)
    {
        $this->homeSliderRepository->update($request->all(), $homeSlider);

        Flash::success(__('Home Slider updated successfully.'));

        return redirect(route('home-slider.index'));
    }

    public function destroy(HomeSlider $homeSlider)
    {
        $homeSlider->delete();

        return $this->sendSuccess('Home Slider deleted successfully.');
    }
}
