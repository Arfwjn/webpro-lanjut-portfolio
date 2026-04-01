<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;

// DashboardController — Single Action Controller untuk halaman admin utama.
class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // Hitung total data untuk ditampilkan di kartu statistik
        $profilesCount  = Profile::count();
        $projectsCount  = Project::count();
        $messagesCount  = ContactMessage::count();
        $unreadCount    = ContactMessage::unread()->count(); // Pesan belum dibaca

        // Semua profil untuk Profile Switcher
        $profiles       = Profile::latest()->get();

        // 5 pesan terbaru untuk preview di dashboard
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