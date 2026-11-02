<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['location', 'label', 'url', 'is_button', 'is_active', 'order'];

    protected $casts = ['is_button' => 'boolean', 'is_active' => 'boolean'];

    public function scopeAt(Builder $query, string $location): Builder
    {
        return $query->where('location', $location)->orderBy('order')->orderBy('id');
    }
}
