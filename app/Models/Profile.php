<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'bio', 'detailed_bio', 'social_links'])]
class Profile extends Model
{
    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'social_links' => 'array',
        ];
    }

    // Komentar dalam bahasa Indonesia: Model Profil untuk portfolio
}
