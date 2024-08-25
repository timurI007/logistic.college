<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'title',
        'subtitle'
    ];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
}
