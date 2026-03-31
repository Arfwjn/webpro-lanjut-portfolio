<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'tech_stack',
        'live_link',
        'github_link',
        'date',
        'profile_id',
    ];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'date'       => 'date',
        ];
    }

    // Relasi ke profil pemilik project ini
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}