<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
// Service model represents services table
class Service extends Model
{
    // Fields allowed to be inserted
    protected $fillable = [
        'office_id',
        'service_category_id',
        'name',
        'description',
        'fee',
        'duration',
        'required_documents',
        'is_active',
    ];
// Service belongs to an office
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
// Service belongs to a category
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
// Service has many citizen requests
    public function requests(): HasMany
    {
        return $this->hasMany(CitizenRequest::class);
    }
// Service has many appointments
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}