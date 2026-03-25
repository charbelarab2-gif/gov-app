<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
// ServiceCategory model represents service categories table
class ServiceCategory extends Model
{
    // Fields allowed to be inserted
    protected $fillable = [
        'office_id',
        'name',
    ];
// Category belongs to an office
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
// Category has many services 
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
