<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'detailed_bio',
        'social_links',
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
        ];
    }
    
    protected $attributes = [
        'social_links' => '[]',
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
}