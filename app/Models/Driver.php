<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $primaryKey = "driver_id";

    protected $fillable = [
        'driver_id',
        'fullname',
        'phone_number',
        'email',
    ];
}
