<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleService extends Model
{
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'vehicle_id',
        'service_date',
        'service_description'
    ];

    /**
     * Relationship with Vehicle
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
