<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
   protected $fillable = [
       'office_id',
       'name',
       'description',
       'fee',
       'duration',
       'required_documents',
       'is_active'
   ];
   public function requests()
   {
       return $this->hasMany(\App\Models\CitizenRequest::class);
   }
}