<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Office extends Model
{
    protected $fillable = [
        'municipality_id',
        'name',
        'email',
        'phone',
        'address',
        'latitude',
        'longitude',
        'working_hours',
        'contact_info',
        'is_active',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
