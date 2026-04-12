<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'bio',
        'license_number',
        'years_experience',
        'max_cases',
        'current_cases',
        'available',
        'languages',
    ];

    protected function casts(): array
    {
        return [
            'available'        => 'boolean',
            'languages'        => 'array',  // JSON → PHP array تلقائياً
            'years_experience' => 'integer',
            'max_cases'        => 'integer',
            'current_cases'    => 'integer',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    // الملف ينتمي لمستخدم (one-to-one عكسي)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    // الدكاترة المتاحون وعندهم مكان لحالات جديدة
    public function scopeAvailableForCases($query)
    {
        return $query->where('available', true)
                     ->whereColumn('current_cases', '<', 'max_cases');
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    // هل يستطيع الدكتور استقبال حالة جديدة؟
    public function canAcceptCase(): bool
    {
        return $this->available
            && $this->current_cases < $this->max_cases;
    }

    // نسبة الإشغال: كم حالة من الحد الأقصى؟
    public function occupancyPercentage(): int
    {
        if ($this->max_cases === 0) return 100;
        return (int) ($this->current_cases / $this->max_cases * 100);
    }
}