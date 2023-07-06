<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    public function comments(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }
}
