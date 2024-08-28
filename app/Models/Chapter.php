<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Chapter extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'title',
        'subtitle'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'parent_id')->select(['id', 'title', 'parent_id']);
    }
    
    public function parents(array $fields = ['*'])
    {
        $parents = collect();

        $parent = $this->parent;

        while ($parent) {
            $parents->prepend($parent);
            $parent = $parent->parent()->select($fields)->get();
        }

        return $parents;
    }

    public function children(): HasMany
    {
        return $this->hasMany(Chapter::class, 'parent_id');
    }

    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }
}
