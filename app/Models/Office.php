<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'name',
        'municipality_id',
        'email',
        'phone',
        'address',
        'latitude',
        'longitude',
        'working_hours',
        'contact_info',
    ];

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}