<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'doctor_id',
        'content',
        'type',
    ];

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function case()
    {
        return $this->belongsTo(MentalCase::class, 'case_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeInternal($query)
    {
        return $query->where('type', 'internal');
    }

    public function scopeVisible($query)
    {
        return $query->where('type', '!=', 'internal');
    }

    public function scopeConcerns($query)
    {
        return $query->where('type', 'concern');
    }
}