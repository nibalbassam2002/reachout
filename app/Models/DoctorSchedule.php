<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_active',
        'notes',
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

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    // الدوام النشط فقط
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // الدكاترة المناوبون الآن
    // الاستخدام: DoctorSchedule::onDutyNow()->with('doctor')->get()
    public function scopeOnDutyNow($query)
    {
        $now     = Carbon::now();
        $day     = strtolower($now->englishDayOfWeek); // 'monday', 'tuesday'...
        $time    = $now->format('H:i:s');

        return $query->active()
                     ->where('day_of_week', $day)
                     ->where('start_time', '<=', $time)
                     ->where('end_time', '>=', $time);
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    // هل هذه الوردية نشطة الآن؟
    public function isOnDutyNow(): bool
    {
        $now  = Carbon::now();
        $day  = strtolower($now->englishDayOfWeek);
        $time = $now->format('H:i:s');

        return $this->is_active
            && $this->day_of_week === $day
            && $this->start_time <= $time
            && $this->end_time >= $time;
    }
}