<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'avatar_path',
        'bio',
        'detailed_bio',
        'social_links',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'is_active'    => 'boolean',
        ];
    }

    protected $attributes = [
        'social_links' => '[]',
        'is_active'    => false,
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getSocialLinksAttribute($value): array
    {
        if (is_null($value)) {
            return [];
        }
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar_path) {
            return Storage::url($this->avatar_path);
        }
        return null;
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials ?: '?';
    }

    /**
     * Set profil ini sebagai aktif (dan nonaktifkan yang lain).
     */
    public function setAsActive(): void
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }

    /**
     * Ambil profil yang sedang aktif, fallback ke profil pertama.
     */
    public static function getActive(): ?static
    {
        return static::where('is_active', true)->first()
            ?? static::latest()->first();
    }
}