<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Driver;
use Exception;
use Ramsey\Uuid\Uuid;

class DriverService
{
    /**
     * Store a new driver record.
     */
    public function store(Request $request)
    {
        try {
            $request['driver_id'] = Uuid::uuid7();
            Driver::create($request->only('driver_id', 'fullname', 'phone_number', 'email'));
        } catch (\Exception $e) {
            error_log("DriverService: " . $e->getMessage());
            throw new Exception("Gagal menambahkan driver baru.");
        }
    }

    /**
     * Update an existing driver record.
     */
    public function update(Request $request, Driver $driver)
    {
        try {
            $driver->update($request->only('fullname', 'phone_number', 'email'));
        } catch (\Exception $e) {
            error_log("DriverService: " . $e->getMessage());
            throw new Exception("Gagal memperbarui data driver.");
        }
    }

    /**
     * Delete a driver record.
     */
    public function delete(Driver $driver)
    {
        try {
            $driver->delete();
        } catch (\Exception $e) {
            error_log("DriverService: " . $e->getMessage());
            throw new Exception("Gagal menghapus driver.");
        }
    }
}
