<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Proses form kontak dan kirim email/log pesan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Log pesan ke storage (tanpa paket email eksternal)
        \Illuminate\Support\Facades\Log::info('Pesan kontak baru', [
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'message' => $validated['message'],
            'ip'      => $request->ip(),
            'at'      => now()->toDateTimeString(),
        ]);

        // Redirect kembali ke home dengan anchor #contact
        return redirect()
            ->to(route('home') . '#contact')
            ->with('success', 'Pesan berhasil dikirim! Saya akan segera merespons.');
    }
}