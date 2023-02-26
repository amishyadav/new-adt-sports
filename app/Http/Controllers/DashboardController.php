<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends AppBaseController
{
    public function index(): Factory|View|Application
    {
        return view('dashboard.dashboard');
    }
}
