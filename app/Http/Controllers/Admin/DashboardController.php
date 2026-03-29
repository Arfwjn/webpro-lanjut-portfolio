<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $profilesCount  = Profile::count();
        $projectsCount  = Project::count();
        $messagesCount  = ContactMessage::count();
        $unreadCount    = ContactMessage::unread()->count();

        $profiles       = Profile::latest()->get();

        // 5 pesan terbaru untuk ditampilkan di dashboard
        $latestMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'profilesCount',
            'projectsCount',
            'messagesCount',
            'unreadCount',
            'profiles',
            'latestMessages'
        ));
    }
}