<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $dashboardService, Request $request)
    {
        $content = $dashboardService->getDashboardView($request->user());

        return view('pages.dashboard', compact('content'));
    }
}
