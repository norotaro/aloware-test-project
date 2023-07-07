<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    public function comments(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('created_at', 'desc');
    }

    protected function edited(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['created_at'] != $attributes['updated_at'],
        );
    }
}
