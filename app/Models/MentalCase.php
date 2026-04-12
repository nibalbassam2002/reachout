<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MentalCase extends Model
{
    use HasFactory, SoftDeletes;

    // نخبر Laravel صراحةً باسم الجدول
    // لأن Laravel سيبحث عن جدول اسمه 'cases_es' تلقائياً
    protected $table = 'cases';

    protected $fillable = [
        'case_number',
        'contact_id',
        'assigned_doctor_id',
        'handler_type',
        'status',
        'channel',
        'priority',
        'bot_summary',
        'admin_notes',
        'assigned_at',
        'first_response_at',
        'resolved_at',
        'closed_at',
        'last_activity_at',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at'       => 'datetime',
            'first_response_at' => 'datetime',
            'resolved_at'       => 'datetime',
            'closed_at'         => 'datetime',
            'last_activity_at'  => 'datetime',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function assignedDoctor()
    {
        return $this->belongsTo(User::class, 'assigned_doctor_id');
    }

    // التصنيفات — many-to-many عبر case_categories
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'case_categories'
        );
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'case_id');
    }

    public function notes()
    {
        return $this->hasMany(CaseNote::class, 'case_id');
    }

    // المحادثة النشطة (الأحدث)
    public function activeConversation()
    {
        return $this->hasOne(Conversation::class, 'case_id')->latest();
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    // الحالات الجديدة التي لم تُعيَّن بعد
    public function scopeUnassigned($query)
    {
        return $query->where('status', 'new');
    }

    // الحالات النشطة (كل شيء ما عدا المغلقة)
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['closed', 'resolved']);
    }

    // الحالات الطارئة
    public function scopeCrisis($query)
    {
        return $query->where('priority', 'crisis');
    }

    // حالات الدكاترة فقط
    public function scopeForDoctors($query)
    {
        return $query->where('handler_type', 'doctor');
    }

    // حالات المشرف فقط (الأرقام الأجنبية)
    public function scopeForAdmin($query)
    {
        return $query->where('handler_type', 'admin');
    }

    // حالات دكتور معين
    public function scopeAssignedTo($query, int $doctorId)
    {
        return $query->where('assigned_doctor_id', $doctorId);
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    // توليد رقم الحالة التلقائي: CASE-2024-00001
    public static function generateCaseNumber(): string
    {
        $year  = date('Y');
        $count = static::whereYear('created_at', $year)->count() + 1;
        return sprintf('CASE-%s-%05d', $year, $count);
    }

    // هل الحالة مفتوحة؟
    public function isOpen(): bool
    {
        return !in_array($this->status, ['closed', 'resolved']);
    }

    // هل هي حالة طارئة؟
    public function isCrisis(): bool
    {
        return $this->priority === 'crisis';
    }

    // تحديث last_activity_at عند كل رسالة جديدة
    public function touchActivity(): void
    {
        $this->update(['last_activity_at' => now()]);
    }
}