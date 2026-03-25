<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Office;
use App\Models\Message;

class Conversation extends Model
{
    protected $fillable = [
        'citizen_id',
        'office_id',
        'request_id',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function citizen()
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}