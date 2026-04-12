<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_profile_id',
        'amount',
        'currency',
        'subscription_type',
        'status',
        'payment_gateway',
        'payment_ref',
        'gateway_subscription_id',
        'next_billing_at',
        'cancelled_at',
        'message',
        'donated_at',
    ];

    protected function casts(): array
    {
        return [
            'amount'          => 'decimal:2',
            'next_billing_at' => 'datetime',
            'cancelled_at'    => 'datetime',
            'donated_at'      => 'datetime',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function donor()
    {
        return $this->belongsTo(DonorProfile::class, 'donor_profile_id');
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeMonthly($query)
    {
        return $query->where('subscription_type', 'monthly');
    }

    public function scopeOneTime($query)
    {
        return $query->where('subscription_type', 'one_time');
    }

    // الاشتراكات الشهرية النشطة
    public function scopeActiveSubscriptions($query)
    {
        return $query->monthly()
                     ->completed()
                     ->whereNull('cancelled_at');
    }

    // الاشتراكات التي تستحق الدفع اليوم (للـ cron job)
    public function scopeDueToday($query)
    {
        return $query->activeSubscriptions()
                     ->whereDate('next_billing_at', today());
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    public function isMonthly(): bool
    {
        return $this->subscription_type === 'monthly';
    }

    public function isCancelled(): bool
    {
        return !is_null($this->cancelled_at);
    }

    // تحديث موعد الدفعة القادمة (+30 يوم)
    public function renewNextBilling(): void
    {
        $this->update([
            'next_billing_at' => now()->addMonth(),
        ]);
    }
}