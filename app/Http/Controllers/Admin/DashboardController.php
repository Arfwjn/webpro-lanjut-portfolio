<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $profilesCount = Profile::count();
        $projectsCount = Project::count();

        return view('admin.dashboard', compact('profilesCount', 'projectsCount'));
    }
}