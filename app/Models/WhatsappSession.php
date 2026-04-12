<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhatsappSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'wa_id',
        'bot_state',
        'collected_data',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            // collected_data يُقرأ كـ array تلقائياً
            // لا نحتاج json_decode يدوي
            'collected_data' => 'array',
            'expires_at'     => 'datetime',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    public function scopeCompleted($query)
    {
        return $query->where('bot_state', 'completed');
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    // تحديث حالة البوت وإضافة بيانات جديدة
    public function updateState(string $newState, array $newData = []): void
    {
        $this->update([
            'bot_state'      => $newState,
            'collected_data' => array_merge(
                $this->collected_data ?? [],
                $newData
            ),
        ]);
    }

    // هل انتهت صلاحية الجلسة؟
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    // هل اكتملت بيانات البوت؟
    public function isCompleted(): bool
    {
        return $this->bot_state === 'completed';
    }
}