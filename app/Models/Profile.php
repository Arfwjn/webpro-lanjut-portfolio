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
        'about_data',
        'roadmap_items',
    ];

    protected function casts(): array
    {
        return [
            'social_links'  => 'array',
            'is_active'     => 'boolean',
            'about_data'    => 'array',
            'roadmap_items' => 'array',
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

    // Jadikan profil ini aktif, nonaktifkan semua profil lain dulu
    public function setAsActive(): void
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }

    // Ambil profil aktif, fallback ke yang terbaru kalau tidak ada
    public static function getActive(): ?static
    {
        return static::where('is_active', true)->first()
            ?? static::latest()->first();
    }

    // About / Identity Section 
    public static function defaultAboutData(): array
    {
        return [
            'experience' => [
                ['title' => 'Junior Web Developer', 'period' => '2025 - Sekarang'],
                ['title' => 'Junior MLOps',          'period' => '2025 - Sekarang'],
                ['title' => 'Machine Learning Specialist', 'period' => ''],
            ],
            'education' => [
                'degree'      => 'Teknik Informatika',
                'institution' => 'STMIK Widya Utama · Lulus 2027',
            ],
            'skills'    => ['Laravel', 'PyTorch', 'TensorFlow', 'Tailwind', 'MySQL', 'Docker'],
            'interests' => ['Machine Learning', 'Deep Learning', 'MLOps', 'Data Science', 'AI/LLM', 'Cloud'],
            'stats'     => [
                ['number' => '1+',  'label' => 'Tahun Pengalaman'],
                ['number' => '10+', 'label' => 'Proyek Selesai'],
                ['number' => '5+',  'label' => 'Klien Puas'],
            ],
        ];
    }

    // Gabung data about dari DB dengan default values (DB override default)
    public function resolvedAboutData(): array
    {
        $defaults = static::defaultAboutData();
        $stored   = $this->about_data ?? [];
        return array_replace_recursive($defaults, $stored);
    }

    // Learning Journey / Roadmap Section 
    public static function defaultRoadmapItems(): array
    {
        return [
            [
                'title' => 'Python & NumPy Mastery',
                'year'  => '2024',
                'desc'  => 'Fondasi ML dengan Python, NumPy, Pandas. Data manipulation dan vectorized operations untuk analisis data skala besar.',
            ],
            [
                'title' => 'Scikit-Learn & TensorFlow',
                'year'  => '2024',
                'desc'  => 'Implementasi algoritma klasik (SVM, Random Forest, K-NN) dan first deep learning model menggunakan Keras.',
            ],
            [
                'title' => 'Computer Vision & NLP',
                'year'  => '2025',
                'desc'  => 'CNN untuk image classification, RNN/LSTM untuk sequence data, fine-tuning pre-trained transformer models (BERT, GPT).',
            ],
            [
                'title' => 'Advanced Deep Learning & MLOps',
                'year'  => '2025 → Now',
                'desc'  => 'GANs, Diffusion Models, LLM fine-tuning. Production ML pipelines dengan MLflow, Docker & Flask. API serving dengan FastAPI.',
            ],
        ];
    }

    // Gabung roadmap dari DB dengan default, tambah color & num (selalu 4 items, step 4 aktif)
    public function resolvedRoadmapItems(): array
    {
        $colors   = ['emerald', 'sky', 'purple', 'gradient'];
        $defaults = static::defaultRoadmapItems();
        $stored   = $this->roadmap_items ?? [];
        $result   = [];

        for ($i = 0; $i < 4; $i++) {
            $item          = array_merge($defaults[$i], $stored[$i] ?? []);
            $item['num']   = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
            $item['color'] = $colors[$i];
            if ($i === 3) {
                $item['is_active'] = true;
            }
            $result[] = $item;
        }

        return $result;
    }
}