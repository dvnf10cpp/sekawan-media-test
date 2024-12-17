<?php

namespace App\Http\Services;

use App\Models\VehicleFuelConsumption;
use Illuminate\Http\Request;
use Exception;

class VehicleFuelConsumptionService
{
    public function store(Request $request)
    {
        try {
            VehicleFuelConsumption::create($request->only([
                'vehicle_id', 'fuel_type', 'fuel_liters', 'fuel_date'
            ]));
        } catch (\Exception $e) {
            error_log("FuelService: " . $e->getMessage());
            throw new Exception("Failed to create fuel consumption record");
        }
    }

    public function update(Request $request, VehicleFuelConsumption $fuelConsumption)
    {
        try {
            $fuelConsumption->fill($request->only([
                'vehicle_id', 'fuel_type', 'fuel_liters', 'fuel_date'
            ]))->save();
        } catch (\Exception $e) {
            error_log("FuelService: " . $e->getMessage());
            throw new Exception("Failed to update fuel consumption record");
        }
    }
}
