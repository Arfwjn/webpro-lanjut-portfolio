<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Model Profile: Data profil yang ditampilkan di portfolio publik.
 *
 * Satu profil berisi: data dasar, social links, about_data (JSON), roadmap_items (JSON).
 * Hanya satu profil yang bisa aktif pada satu waktu (is_active = true).
 *
 * @property int            $id
 * @property string         $name
 * @property string|null    $avatar_path
 * @property string         $bio              Bio singkat untuk Hero section
 * @property string|null    $detailed_bio     Bio panjang untuk About section
 * @property array          $social_links    
 * @property bool           $is_active        Hanya 1 profil aktif di satu waktu
 * @property array|null     $about_data       Lihat defaultAboutData() untuk strukturnya
 * @property array|null     $roadmap_items    Lihat defaultRoadmapItems() untuk strukturnya
 */
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

    // Default is_active = false agar profil baru tidak otomatis aktif
    protected $attributes = [
        'social_links' => '[]',
        'is_active'    => false,
    ];

    // Relationships

    // Satu profil bisa punya banyak proyek.
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Accessors
    public function getSocialLinksAttribute($value): array
    {
        if (is_null($value)) {
            return [];
        }
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    // URL publik avatar, atau null jika tidak ada foto.
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar_path) {
            return Storage::url($this->avatar_path);
        }
        return null;
    }

    /**
     * Inisial nama untuk placeholder avatar (maks 2 huruf).
     * Contoh: "Arief Sidik" → "AS", "John" → "J"
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', trim($this->name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials ?: '?';
    }

    // Methods

    // Set profil ini sebagai satu-satunya yang aktif.
    // Nonaktifkan semua profil dulu, lalu aktifkan yang ini.
    public function setAsActive(): void
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }

    // Ambil profil yang sedang aktif.
    public static function getActive(): ?static
    {
        return static::where('is_active', true)->first()
            ?? static::latest()->first();
    }

    // About / Identity Section

    /**
     * Nilai default untuk kolom about_data.
     * Dipakai: (1) saat form create untuk pre-fill input, (2) sebagai fallback di resolvedAboutData().
     *
     * Struktur:
     * - experience: [{title, period}]
     * - education:  {degree, institution}
     * - skills:     [string]
     * - interests:  [string]
     * - stats:      [{number, label}] (selalu 3 item)
     */
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

    /**
     * Gabungkan data about dari DB dengan nilai default.
     * Data dari DB (yang sudah diisi admin) akan override default-nya.
     */
    public function resolvedAboutData(): array
    {
        $defaults = static::defaultAboutData();
        $stored   = $this->about_data ?? [];
        return array_replace_recursive($defaults, $stored);
    }

    // Learning Journey / Roadmap Section

    /**
     * Nilai default untuk kolom roadmap_items.
     * Selalu 4 item; step terakhir (index 3) adalah tahap terkini/aktif.
     *
     * Struktur tiap item: {title, year, desc}
     */
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

    // Gabungkan roadmap dari DB dengan default, lalu tambahkan metadata render   
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
                $item['is_active'] = true; // Step 4 selalu animasi pulse
            }
            $result[] = $item;
        }

        return $result;
    }
}