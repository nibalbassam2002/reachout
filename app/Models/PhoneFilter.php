<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhoneFilter extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'reason',
        'created_by',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAllowedCountries($query)
    {
        return $query->active()->where('type', 'allowed_country');
    }

    public function scopeRedirectToAdmin($query)
    {
        return $query->active()->where('type', 'redirect_to_admin');
    }

    public function scopeBlockedNumbers($query)
    {
        return $query->active()->where('type', 'blocked_number');
    }

    // ─────────────────────────────────────────
    // STATIC HELPERS — منطق الفلترة الكامل
    // ─────────────────────────────────────────

    // السؤال الرئيسي: ماذا نفعل بهذا الرقم؟
    // يُعيد: 'allow' | 'block' | 'redirect_to_admin'
    public static function checkNumber(string $phoneNumber): string
    {
        // 1. هل الرقم محظور مباشرة؟
        $isBlocked = static::active()
            ->where('type', 'blocked_number')
            ->where('value', $phoneNumber)
            ->exists();

        if ($isBlocked) return 'block';

        // 2. استخرج كود الدولة من الرقم
        // مثال: '+970599123456' → '+970'
        $countryCode = static::extractCountryCode($phoneNumber);

        // 3. هل دولته محظورة؟
        $isBlockedCountry = static::active()
            ->where('type', 'blocked_country')
            ->where('value', $countryCode)
            ->exists();

        if ($isBlockedCountry) return 'block';

        // 4. هل يجب تحويله للمشرف؟
        $redirectToAdmin = static::active()
            ->where('type', 'redirect_to_admin')
            ->where('value', $countryCode)
            ->exists();

        if ($redirectToAdmin) return 'redirect_to_admin';

        // 5. هل الدول المسموح بها محددة؟
        $allowedCountries = static::allowedCountries()->pluck('value');

        if ($allowedCountries->isNotEmpty()) {
            return $allowedCountries->contains($countryCode)
                ? 'allow'
                : 'block';
        }

        // 6. لا توجد قيود → مسموح
        return 'allow';
    }

    // استخراج كود الدولة من رقم الهاتف
    private static function extractCountryCode(string $phone): string
    {
        // الأكواد الأطول أولاً لتجنب التعارض
        // مثال: +970 قبل +97
        $codes = [
            '+972', '+970', '+1', '+44', '+49',
            '+33', '+39', '+34', '+7', '+86',
            '+91', '+20', '+966', '+971', '+962',
            '+961', '+963', '+964', '+965', '+968',
        ];

        foreach ($codes as $code) {
            if (str_starts_with($phone, $code)) {
                return $code;
            }
        }

        return substr($phone, 0, 4); // fallback
    }
}