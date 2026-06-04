<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyComplaint extends Model
{
    protected $fillable = [
        'contact_info',
        'type_of_concern',
        'details',
        'status',
        'is_read',
        'ip_address',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Scope للشكاوى الجديدة غير المقروءة
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope للشكاوى الجديدة
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}