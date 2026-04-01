<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

/**
 * MessageController: Kelola pesan masuk dari form kontak publik.
 *
 * Fitur: tampil list, baca detail (auto-mark read), tandai baca, hapus.
 * Tidak ada create/update karena pesan dikirim oleh pengunjung via ContactController.
 */
class MessageController extends Controller
{
    // Tampilkan semua pesan, diurutkan terbaru, 15 item per halaman.
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    // Tampilkan detail satu pesan.
    // Jika pesan belum dibaca, otomatis ditandai sudah dibaca saat dibuka.
    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->markAsRead();
        }
        return view('admin.messages.show', compact('message'));
    }

    // Tandai satu pesan sebagai sudah dibaca
    public function markRead(ContactMessage $message)
    {
        $message->markAsRead();
        return redirect()->back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    // Tandai semua pesan yang belum dibaca sekaligus (bulk update).
    public function markAllRead()
    {
        ContactMessage::unread()->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Semua pesan ditandai sudah dibaca.');
    }

    // Hapus satu pesan secara permanen, lalu redirect ke list.
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}