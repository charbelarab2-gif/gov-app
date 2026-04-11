<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CitizenRequest extends Model
{
    // fields allowed to be inserted
   protected $fillable = [
       'user_id',
       'service_id',
       'status',
   ];

   public function user()
   {
       return $this->belongsTo(\App\Models\User::class);
   }

   public function service()
   {
       return $this->belongsTo(\App\Models\Service::class);
   }

   // ✅ ADDED (helps if office is still used somewhere)
   public function office()
   {
       return $this->belongsTo(\App\Models\Office::class);
   }
}