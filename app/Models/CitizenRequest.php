<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// CitizenRequest model represents citizen requests table
class CitizenRequest extends Model
{
    // fields allowed to be inserted
   protected $fillable = [
       'user_id',
       'service_id',
       'status',
   ];
   // Request belongs to a user
   public function user()
   {
       return $this->belongsTo(\App\Models\User::class);
   }
   // Request belongs to a service 
   public function service()
   {
       return $this->belongsTo(\App\Models\Service::class);
   }
}