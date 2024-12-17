<?php

namespace App\Http\Controllers;

use App\Http\Services\VehicleService;
use App\Http\Services\LogService;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    private $vehicleSvc;
    private $logSvc;

    public function __construct()
    {
        $this->vehicleSvc = new VehicleService();
        $this->logSvc = new LogService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::paginate(10);

        return view('pages.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate($this->rules(), $this->rulesMessage());

        try {
            $this->vehicleSvc->store($request);

            $this->logSvc->create('membuat mobil ' . $request['vehicle_name']);



            return redirect()->route('vehicles.pages.index')->with('success', 'Successfully create new vehicle');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load('reservations', 'reservations');

        return view('pages.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('pages.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate($this->rules(), $this->rulesMessage());

        try {
            $this->vehicleSvc->update($request, $vehicle);

            return redirect()->route('vehicles.pages.index')->with('success', 'Successfully update vehicle data');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    private function rules()
    {
        return [
            'vehicle_name' => 'required|min:5|max:50',
            'vehicle_type' => 'required|in:Passenger,Cargo',
            'vehicle_owner' => 'required|in:Company,Rental'
        ];
    }

    private function rulesMessage()
    {
        return [
            'vehicle_name.requried' => 'Nama Kendaraan wajib diisi',
            'vehicle_name.min' => 'Minimal panjang nama kendaraan adalah 5 karakter',
            'vehicle_name.max' => 'Maksimal panjang nama kendaraan adalah 50 karakter',
            'vehicle_type.required' => 'Tipe kendaraan wajib diisi',
            'vehicle_type.in' => 'Tipe kendaraan harus merupakan Passenger atau Cargo',
            'vehicle_owner.required' => 'Pemilik kendaraan wajib diisi',
            'vehicle_owner.in' => 'Pemilik kendaraan harus merupakan Company atau Rental'
        ];
    }
}
