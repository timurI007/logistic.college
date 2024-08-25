<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Slide extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['content'];

    public function presentation(): BelongsTo
    {
        return $this->belongsTo(Presentation::class);
    }
}
