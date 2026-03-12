<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'office_id',
        'service_id',
        'citizen_name',
        'citizen_email',
        'citizen_phone',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
        'email_reminder_sent_at',
        'sms_reminder_sent_at',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'email_reminder_sent_at' => 'datetime',
        'sms_reminder_sent_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}