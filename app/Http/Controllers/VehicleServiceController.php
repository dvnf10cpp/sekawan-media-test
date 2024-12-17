<?php

namespace App\Http\Controllers;

use App\Http\Services\VehicleServiceService;
use App\Http\Services\LogService;
use App\Models\Vehicle;
use App\Models\VehicleService;
use Illuminate\Http\Request;

class VehicleServiceController extends Controller
{
    private $vehicleServiceSvc;
    private $logSvc;

    public function __construct()
    {
        $this->vehicleServiceSvc = new VehicleServiceService();
        $this->logSvc = new LogService();
    }

    /**
     * List all vehicle services.
     */
    public function index()
    {
        $services = VehicleService::paginate(10);
        return view('pages.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new vehicle service.
     */
    public function create()
    {
        $vehicles = Vehicle::all(); // Fetch all available vehicles
        return view('pages.services.create', compact('vehicles'));
    }

    /**
     * Store a newly created vehicle service.
     */
    public function store(Request $request)
    {

        $request->validate($this->rules(), $this->rulesMessage());

        try {
            $this->vehicleServiceSvc->store($request);
            $this->logSvc->create('Created a new vehicle service for Vehicle ID ' . $request['vehicle_id']);

            return redirect()->route('services.pages.index')->with('success', 'Vehicle service created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show a single vehicle service.
     */
    public function show(VehicleService $service)
    {
        return view('pages.services.show', compact('service'));
    }

    /**
     * Show the form for editing an existing vehicle service.
     */
    public function edit(VehicleService $service)
    {
        $vehicles = Vehicle::all(); // Fetch all vehicles
        return view('pages.services.edit', compact('service', 'vehicles'));
    }

    /**
     * Update an existing vehicle service.
     */
    public function update(Request $request, VehicleService $service)
    {
        $request->validate($this->rules(), $this->rulesMessage());

        try {
            $this->vehicleServiceSvc->update($request, $service);
            $this->logSvc->create('Updated vehicle service ID ' . $service->service_id);

            return redirect()->route('services.pages.index')->with('success', 'Vehicle service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    /**
     * Delete a vehicle service.
     */
    public function destroy(VehicleService $service)
    {
        try {
            $this->vehicleServiceSvc->delete($service);
            $this->logSvc->create('Deleted vehicle service ID ' . $service->service_id);

            return redirect()->route('services.pages.index')->with('success', 'Vehicle service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Validation rules.
     */
    private function rules()
    {
        return [
            'service_date' => 'required|date',
            'service_description' => 'required|string|max:1000',
        ];
    }

    private function rulesMessage()
    {
        return [
            'service_date.required' => 'Service date is required.',
            'service_date.date' => 'Service date must be a valid date.',
            'service_description.required' => 'Service description is required.',
            'service_description.max' => 'Service description cannot exceed 1000 characters.',
        ];
    }
}
