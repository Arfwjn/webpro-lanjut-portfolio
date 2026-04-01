<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

/**
 * ContactController — Terima dan simpan pesan dari form kontak publik.
 *
 * Hanya punya satu method (store) karena form kontak tidak butuh CRUD penuh.
 * Pesan yang masuk bisa dikelola admin via Admin\MessageController.
 */
class ContactController extends Controller
{
    /**
     * Validasi dan simpan pesan masuk ke database.
     * IP pengirim disimpan untuk keperluan audit/anti-spam dasar.
     * Setelah sukses, redirect ke section #contact di homepage dengan flash message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

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