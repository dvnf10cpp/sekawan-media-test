<?php

namespace App\Http\Controllers;

use App\Http\Services\VehicleFuelConsumptionService;
use App\Models\Vehicle;
use App\Models\VehicleFuelConsumption;
use Illuminate\Http\Request;

class VehicleFuelConsumptionController extends Controller
{
    private $fuelService;

    public function __construct()
    {
        $this->fuelService = new VehicleFuelConsumptionService();
    }

    public function index()
    {
        $fuelConsumptions = VehicleFuelConsumption::with('vehicle')->paginate(10);
        return view('pages.fuel_consumptions.index', compact('fuelConsumptions'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('pages.fuel_consumptions.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        try {
            $this->fuelService->store($request);
            return redirect()->route('fuel.pages.index')->with('success', 'Fuel consumption record added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function edit(VehicleFuelConsumption $fuelConsumption)
    {
        $vehicles = Vehicle::all();
        return view('pages.fuel_consumptions.edit', compact('fuelConsumption', 'vehicles'));
    }

    public function update(Request $request, VehicleFuelConsumption $fuelConsumption)
    {
        $request->validate($this->rules(), $this->messages());

        try {
            $this->fuelService->update($request, $fuelConsumption);
            return redirect()->route('fuel.pages.index')->with('success', 'Fuel consumption record updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    public function destroy(VehicleFuelConsumption $fuelConsumption)
    {
        $fuelConsumption->delete();
        return redirect()->route('fuel.pages.index')->with('success', 'Record deleted successfully');
    }

    private function rules()
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,vehicle_id',
            'fuel_type' => 'required|in:Diesel,Petrol,Gasoline',
            'fuel_liters' => 'required|numeric|min:0.1',
            'fuel_date' => 'required|date',
        ];
    }

    private function messages()
    {
        return [
            'vehicle_id.required' => 'Vehicle selection is required.',
            'fuel_type.required' => 'Fuel type is required.',
            'fuel_liters.required' => 'Fuel liters field is required.',
            'fuel_date.required' => 'Fuel date is required.',
        ];
    }
}
