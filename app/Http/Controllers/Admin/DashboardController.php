<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $profilesCount = \App\Models\Profile::count();
        $projectsCount = \App\Models\Project::count();

        return view('admin.dashboard', compact('profilesCount', 'projectsCount'));
    }

    // Dashboard admin terpadu untuk kelola profile dan projects dengan Laravel auth middleware
}
