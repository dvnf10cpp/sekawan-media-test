<?php

namespace App\Http\Services;

use App\Models\VehicleService;
use Exception;
use App\Models\Vehicle;

class VehicleServiceService
{
    public function store($request)
    {
        
        $vehicle = Vehicle::where('vehicle_name', $request->vehicle_name)->firstOrFail();


        VehicleService::create([
            'vehicle_id' => $vehicle->vehicle_id,
            'service_date' => $request->service_date,
            'service_description' => $request->service_description,
        ]);
    }

    public function update($request, VehicleService $service)
    {

        $vehicle = Vehicle::where('vehicle_name', $request->vehicle_name)->firstOrFail();


        $service->update([
            'vehicle_id' => $vehicle->vehicle_id,
            'service_date' => $request->service_date,
            'service_description' => $request->service_description,
        ]);
    }


    /**
     * Delete a vehicle service record.
     */
    public function delete(VehicleService $service)
    {
        try {
            $service->delete();
        } catch (\Exception $e) {
            error_log("VehicleServiceService: " . $e->getMessage());
            throw new Exception("Failed to delete vehicle service.");
        }
    }
}
