<?php

namespace App\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{
    protected $table = 'emails';

    protected $fillable = [
        'user_id',
        'recipient',
        'subject',
        'type',
        'status',
        'provider',
        'attempts',
        'queued_at',
        'sent_at',
        'failed_at',
        'error_message',
        'metadata',
    ];

    protected $casts = [
        'queued_at' => 'datetime',
        'sent_at' => 'datetime',
        'failed_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}