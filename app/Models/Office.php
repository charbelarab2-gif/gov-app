<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'name',
        'municipality_id',
    ];

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}