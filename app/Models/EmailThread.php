<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'thread_id',
        'subject',
        'from_email',
        'to_email',
    ];

    // ─────────────────────────────────────────
    // RELATIONSHIPS
    // ─────────────────────────────────────────

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}