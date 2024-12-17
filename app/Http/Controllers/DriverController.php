<?php

namespace App\Http\Controllers;

use App\Http\Services\DriverService;
use App\Http\Services\LogService;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    private $driverSvc;
    private $logSvc;

    public function __construct()
    {
        $this->driverSvc = new DriverService();
        $this->logSvc = new LogService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::paginate(10);
        return view('pages.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->rulesMessage());

        try {
            $this->driverSvc->store($request);

            $this->logSvc->create('Menambahkan driver baru ' . $request['fullname']);

            return redirect()->route('drivers.pages.index')->with('success', 'Driver berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return view('pages.drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('pages.drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $request->validate($this->rules($driver->driver_id), $this->rulesMessage());

        try {
            $this->driverSvc->update($request, $driver);

            return redirect()->route('drivers.pages.index')->with('success', 'Driver berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        try {
            $this->driverSvc->delete($driver);

            $this->logSvc->create('Menghapus driver ' . $driver->fullname);

            return redirect()->route('drivers.pages.index')->with('success', 'Driver berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    private function rules($id = null)
    {
        return [
            'fullname' => 'required|min:3|max:100',
            'phone_number' => 'required',
            'email' => 'required|email|unique:drivers,email,' . ($id ?? '') . ',driver_id',
        ];
    }

    private function rulesMessage()
    {
        return [
            'fullname.required' => 'Nama lengkap wajib diisi',
            'fullname.min' => 'Nama lengkap minimal 3 karakter',
            'fullname.max' => 'Nama lengkap maksimal 100 karakter',
            'phone_number.required' => 'Nomor telepon wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan'
        ];
    }
}
