<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MoonShine\MoonShineAuth;

class Socialite extends Model
{
    protected $fillable = [
        'moonshine_user_id',
        'driver',
        'identity',
    ];

    public function moonshineUser(): BelongsTo
    {
        $model = MoonShineAuth::model();

        return $this->belongsTo(
            $model::class,
            'moonshine_user_id',
            $model?->getKeyName() ?? 'id',
        );
    }
}
