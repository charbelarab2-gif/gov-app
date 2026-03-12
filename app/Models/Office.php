<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceRequest; // ADDED

class Office extends Model
{
    protected $fillable = [
        'name',
        'municipality',
        'address'
    ];

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);


    }

    public function requests()
{
return $this->hasMany(ServiceRequest::class);
}

}