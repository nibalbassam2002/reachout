<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_type',
        'sender_id',
        'body',
        'type',
        'external_id',
        'status',
        'is_flagged',
        'read_by_admin_at',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'is_flagged'       => 'boolean',
            'sent_at'          => 'datetime',
            'read_by_admin_at' => 'datetime',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    // sender polymorphic — المرسل قد يكون User أو Contact
    public function sender()
    {
        return match($this->sender_type) {
            'doctor', 'admin' => User::find($this->sender_id),
            'contact'         => $this->conversation->case->contact,
            default           => null, // bot
        };
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeFlagged($query)
    {
        return $query->where('is_flagged', true);
    }

    public function scopeUnreadByAdmin($query)
    {
        return $query->whereNull('read_by_admin_at');
    }

    public function scopeFromContact($query)
    {
        return $query->where('sender_type', 'contact');
    }

    // ─────────────────────────────────────────
    // HELPERS + BOOT
    // ─────────────────────────────────────────

    // boot: ينفَّذ تلقائياً عند إنشاء كل رسالة جديدة
    protected static function boot()
    {
        parent::boot();

        static::created(function (Message $message) {
            // 1. فحص كلمات الطوارئ تلقائياً
            $message->checkForCrisisKeywords();

            // 2. تحديث المحادثة
            $fromContact = $message->sender_type === 'contact';
            $message->conversation->recordNewMessage($fromContact);
        });
    }

    // فحص كلمات الطوارئ في الرسالة
    private function checkForCrisisKeywords(): void
    {
        $keywords = [
            'suicide', 'kill myself', 'end my life',
            'want to die', 'self harm', 'hurt myself',
            'انتحار', 'أقتل نفسي', 'أموت', 'إيذاء نفسي',
        ];

        $bodyLower = strtolower($this->body);

        foreach ($keywords as $keyword) {
            if (str_contains($bodyLower, $keyword)) {
                $this->update([
                    'is_flagged' => true,
                    'status'     => 'sent',
                ]);

                // رفع الحالة لـ crisis
                $this->conversation->case->update([
                    'priority' => 'crisis',
                    'status'   => 'escalated',
                ]);

                break;
            }
        }
    }
}