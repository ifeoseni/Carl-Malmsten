<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCard extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'url', 'is_active', 'order'];

    protected $casts = ['is_active' => 'boolean'];

    public function iconUrl(): ?string
    {
        if (! $this->icon) {
            return null;
        }

        return preg_match('#^(https?:)?//#', $this->icon) ? $this->icon : asset(ltrim($this->icon, '/'));
    }
}
