<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

// Fillable و Hidden بأسلوب Laravel 13 الجديد
#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'is_active',
    'phone',
    'avatar',
    'last_login_at',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    // ─────────────────────────────────────────
    // CASTS
    // ─────────────────────────────────────────
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
            'last_login_at'     => 'datetime',
        ];
    }

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function doctorProfile()
    {
        return $this->hasOne(DoctorProfile::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    public function assignedCases()
    {
        return $this->hasMany(MentalCase::class, 'assigned_doctor_id');
    }

    public function caseNotes()
    {
        return $this->hasMany(CaseNote::class, 'doctor_id');
    }

    public function phoneFilters()
    {
        return $this->hasMany(PhoneFilter::class, 'created_by');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // ─────────────────────────────────────────
    // SCOPES
    // ─────────────────────────────────────────

    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'super_admin');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isDoctor(): bool
    {
        return $this->role === 'doctor';
    }

    public function isAvailable(): bool
    {
        return $this->isDoctor()
            && $this->is_active
            && $this->doctorProfile?->available;
    }
}
