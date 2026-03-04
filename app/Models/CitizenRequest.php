<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CitizenRequest extends Model
{
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
}