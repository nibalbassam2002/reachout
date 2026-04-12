<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    // التصنيف لديه حالات كثيرة — many-to-many
    public function cases()
    {
        return $this->belongsToMany(
            MentalCase::class,
            'case_categories'
        );
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->orderBy('sort_order');
    }
}