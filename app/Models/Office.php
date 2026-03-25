<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
// Office model represents offices table 
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
// Office has many service

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

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
}
