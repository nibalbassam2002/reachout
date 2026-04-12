<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'channel',
        'display_name',
        'age_range',
        'gender',
        'country_code',
        'is_blocked',
        'first_contact_at',
        'last_contact_at',
    ];

    protected function casts(): array
    {
        return [
            'is_blocked'       => 'boolean',
            'first_contact_at' => 'datetime',
            'last_contact_at'  => 'datetime',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function cases()
    {
        return $this->hasMany(MentalCase::class);
    }

    public function whatsappSession()
    {
        return $this->hasOne(WhatsappSession::class);
    }

    // آخر حالة مفتوحة
    public function activeCase()
    {
        return $this->hasOne(MentalCase::class)
                    ->whereNotIn('status', ['closed', 'resolved'])
                    ->latest();
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeWhatsapp($query)
    {
        return $query->where('channel', 'whatsapp');
    }

    public function scopeNotBlocked($query)
    {
        return $query->where('is_blocked', false);
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    // هل لديه حالة نشطة حالياً؟
    public function hasActiveCase(): bool
    {
        return $this->cases()
                    ->whereNotIn('status', ['closed', 'resolved'])
                    ->exists();
    }
}