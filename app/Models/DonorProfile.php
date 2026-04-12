<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'is_anonymous',
        'country',
    ];

    protected function casts(): array
    {
        return [
            'is_anonymous' => 'boolean',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // الاشتراكات الشهرية النشطة فقط
    public function activeSubscriptions()
    {
        return $this->hasMany(Donation::class)
                    ->where('subscription_type', 'monthly')
                    ->where('status', 'completed')
                    ->whereNull('cancelled_at');
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    // إجمالي ما تبرع به هذا الشخص
    public function totalDonated(): float
    {
        return $this->donations()
                    ->where('status', 'completed')
                    ->sum('amount');
    }

    // الاسم المعروض (مجهول أو الاسم الحقيقي)
    public function displayName(): string
    {
        return $this->is_anonymous ? 'Anonymous' : $this->name;
    }
}