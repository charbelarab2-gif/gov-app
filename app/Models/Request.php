<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'qr_code',
        'qr_code_path',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}