<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'image_path', 'tech_stack', 'live_link', 'github_link', 'date'])]
class Project extends Model
{
    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'date' => 'date',
        ];
    }

    /**
     * Relasi ke Profile (optional).
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Komentar dalam bahasa Indonesia: Model Proyek untuk portfolio dengan dukungan gambar Storage
}
