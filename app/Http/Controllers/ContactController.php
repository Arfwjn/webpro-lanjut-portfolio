<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Simpan ke database
        ContactMessage::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'message'    => $validated['message'],
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->to(route('home') . '#contact')
            ->with('success', 'Pesan berhasil dikirim! Saya akan segera merespons.');
    }
}