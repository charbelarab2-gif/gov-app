<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Appointment model represents appointments table
class Appointment extends Model
{
    // Fields allow to be inserted
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
// convert fields to correct data types
    protected $casts = [
        'appointment_date' => 'date',
        'email_reminder_sent_at' => 'datetime',
        'sms_reminder_sent_at' => 'datetime',
    ];
// appointment belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
// Appointment belongs to an office
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
// Appointment belongs to a service 
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}