<?php

namespace App\Http\Controllers;

use App\Exports\ReservationExport;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Services\ReservationService;
use App\Models\Driver;
use App\Models\Mine;
use Maatwebsite\Excel\Facades\Excel;

class ReservationController extends Controller
{
    private $reservationSvc;

    public function __construct()
    {
        $this->reservationSvc = new ReservationService();
    }

    public function exportExcel()
    {
        return Excel::download(new ReservationExport, 'laporan_periodik_pemesanan.xlsx');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = $this->reservationSvc->fetch(10, [
            'status' => request('status')
        ]);

        return view('pages.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $vehicles = Vehicle::all();
        $users = User::with('role')->whereHas('role', function($query) {
            $query->where('role_name', '=', 'Approver');
        })->get();
        $drivers = Driver::all();
        $mines = Mine::all();


        return view('pages.reservations.create', compact('vehicles', 'users', 'drivers', 'mines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->rulesMessage());


        try {

            $this->reservationSvc->store($request);

            return redirect()->route('reservations.pages.index')->with('success', 'Successfully create new reservation');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservation = $this->reservationSvc->fetchOne($reservation);

        return view('pages.reservations.show', compact('reservation'));
    }

    public function pending(Reservation $reservation)
    {
        return view('pages.reservations.pendings', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $reservation->load('vehicle', 'approvals', 'approvals.approver', 'driver');

        $drivers = Driver::all();
        $mines = Mine::all();

        $vehicles = Vehicle::all();

        $users = User::with('role')->whereHas('role', function($query) {
            $query->where('role_name', '=', 'Approver');
        })->get();

        return view('pages.reservations.edit', compact('reservation', 'vehicles', 'users', 'drivers', 'mines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate($this->rules(), $this->rulesMessage());
        try {
            $this->reservationSvc->update($request, $reservation);

            return redirect()->route('reservations.pages.index')->with('success', "Successfully update reservation");

        } catch(\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    private function rules()
    {
        return [

            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }

    private function rulesMessage()
    {
        return [

            'start_date.required' => 'Tanggal mulai wajib diisi',
            'start_date.date' => 'Tanggal mulai wajib merupakan tanggal yang valid',
            'end_date.required' => 'Tanggal selesai wajib diisi',
            'end_date.date' => 'Tanggal selesai wajib merupakan tanggal yang valid',
        ];
    }
}
