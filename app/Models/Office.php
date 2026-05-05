<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ServiceRequest; // for service requests
use App\Models\Municipality;

class Office extends Model
{
    // Fields allowed to be inserted
    protected $fillable = [
        'municipality_id',
        'name',
        'email',
        'phone',
        'address',
        'google_maps_url',
        'latitude',
        'longitude',
        'working_hours',
        'contact_info',
        'is_active',
    ];

    // Relations

    // Office has many service requests
    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    // Office has many conversations
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    // Office has many services
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    // Office has many service categories
    public function serviceCategories(): HasMany
    {
        return $this->hasMany(ServiceCategory::class);
    }

    // Office has many appointments
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function municipality()
{
    return $this->belongsTo(Municipality::class);
}
}