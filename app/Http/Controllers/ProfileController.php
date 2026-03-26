<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class ProfileController extends Controller
{    
    public function index()
    {
        $profiles = Profile::latest()->get();
        return view('profiles.index', compact('profiles'));
    }

    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }
}