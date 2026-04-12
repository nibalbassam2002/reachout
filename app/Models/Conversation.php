<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'channel',
        'last_message_at',
        'unread_count',
        'admin_unread_count',
        'started_at',
    ];

    protected function casts(): array
    {
        return [
            'last_message_at'    => 'datetime',
            'started_at'         => 'datetime',
            'unread_count'       => 'integer',
            'admin_unread_count' => 'integer',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function case()
    {
        return $this->belongsTo(MentalCase::class, 'case_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function emailThread()
    {
        return $this->hasOne(EmailThread::class);
    }

    // آخر رسالة فقط
    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeWhatsapp($query)
    {
        return $query->where('channel', 'whatsapp');
    }

    public function scopeEmail($query)
    {
        return $query->where('channel', 'email');
    }

    // محادثات فيها رسائل غير مقروءة للمشرف
    public function scopeWithAdminUnread($query)
    {
        return $query->where('admin_unread_count', '>', 0);
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    // تحديث وقت آخر رسالة وزيادة عداد غير المقروء
    public function recordNewMessage(bool $fromContact = true): void
    {
        $this->increment('unread_count');

        if ($fromContact) {
            $this->increment('admin_unread_count');
        }

        $this->update(['last_message_at' => now()]);

        // تحديث last_activity_at في الحالة أيضاً
        $this->case?->touchActivity();
    }

    // مسح عداد غير المقروء للدكتور
    public function markAsReadByDoctor(): void
    {
        $this->update(['unread_count' => 0]);
    }

    // مسح عداد غير المقروء للمشرف
    public function markAsReadByAdmin(): void
    {
        $this->update(['admin_unread_count' => 0]);
        $this->messages()
             ->whereNull('read_by_admin_at')
             ->update(['read_by_admin_at' => now()]);
    }
}