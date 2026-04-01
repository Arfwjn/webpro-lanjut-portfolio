<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model ContactMessage: Pesan masuk dari form kontak.
 *
 * @property int     $id
 * @property string  $name
 * @property string  $email
 * @property string  $message
 * @property string  $ip_address  IP pengirim
 * @property bool    $is_read     Status baca default false (belum dibaca)
 */
class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'ip_address',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Methods
    public function markAsRead(): void
    {
        $this->update(['is_read' => true]);
    }
}