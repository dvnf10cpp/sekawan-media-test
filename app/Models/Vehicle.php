<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $primaryKey  = 'vehicle_id';
    protected $fillable = [
        'vehicle_name',
        'vehicle_type',
        'vehicle_owner',
        'number_plate'
    ];
    use HasFactory;

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'vehicle_id', 'vehicle_id');
    }
}
