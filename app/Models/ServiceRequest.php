<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Office;

class ServiceRequest extends Model
{

protected $fillable = [
'title',
'description',
'office_id',
'user_id'
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function office()
{
    return $this->belongsTo(Office::class);
}

}