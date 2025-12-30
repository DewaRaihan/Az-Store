<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'path',
        'status',
    ];

    // Relationship with parent model (Transaction, Hp, etc.)
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    // Accessor untuk mendapatkan URL gambar
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    // Scope untuk main images
    public function scopeMain($query)
    {
        return $query->where('status', 'main');
    }

    // Scope untuk additional images
    public function scopeAdditional($query)
    {
        return $query->where('status', 'additional');
    }
}