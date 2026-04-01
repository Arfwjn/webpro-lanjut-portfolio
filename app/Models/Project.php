<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Project: Data proyek portfolio.
 *
 * @property int            $id
 * @property int|null       $profile_id   
 * @property string         $title
 * @property string         $description
 * @property string|null    $image_path   
 * @property array          $tech_stack  
 * @property string|null    $live_link    URL demo live
 * @property string|null    $github_link  URL repo GitHub
 * @property \Carbon\Carbon $date      
 */
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

    // Relationships
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}