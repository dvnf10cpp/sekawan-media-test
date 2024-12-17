<?php

namespace App\Http\Services;

use App\Exceptions\ServiceException;
use App\Models\{Approval, Driver, Mine, Reservation, User, Vehicle};
use App\Http\Services\LogService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Amp;

class ReservationService
{
    private $logSvc;

    public function __construct()
    {
        $this->logSvc = new LogService();
    }

    /** Fetch Reservations with Filters and Status */
    public function fetch(int $pagination = 10, array $filters = [])
    {
        $reservations = Reservation::with(['vehicle', 'admin', 'approvals', 'driver', 'mine']);

        if ($this->isApprover()) {
            $filters['approver'] = auth()->user()->user_id;
        }

        $reservations->filter($filters);
        $reservations = $reservations->paginate($pagination);

        foreach ($reservations as $reservation) {
            $reservation['status'] = $this->resolveStatus($reservation->approvals);
        }

        return $reservations;
    }

    /** Fetch Single Reservation */
    public function fetchOne(Reservation $reservation)
    {
        $reservation->load('vehicle', 'approvals', 'approvals.approver', 'admin');
        $reservation['status'] = $this->resolveStatus($reservation->approvals);

        return $reservation;
    }

    /** Store Reservation */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        try {
            DB::beginTransaction();

            $vehicle = $this->fetchResource(Vehicle::class, 'vehicle_name', $request['vehicle_name']);
            $driver = $this->fetchResource(Driver::class, 'fullname', $request['driver_name']);
            $mine = $this->fetchResource(Mine::class, 'mine_name', $request['mine_name']);
            $approvers = $this->fetchApprovers($request['approvers']);

            $this->validateDateRange($request['start_date'], $request['end_date']);

            $reservation = Reservation::create([
                'vehicle_id' => $vehicle->vehicle_id,
                'admin_id'   => auth()->user()->user_id,
                'driver_id'  => $driver->driver_id,
                'mine_id'    => $mine->mine_id,
                'start_date' => Carbon::parse($request['start_date']),
                'end_date'   => Carbon::parse($request['end_date'])
            ]);

            $this->createApprovals($approvers, $reservation);

            $this->logSvc->create("membuat pemesanan kendaraan {$vehicle->vehicle_name} untuk pengemudi {$driver->fullname}");

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->handleException($e, "Failed to create new reservation");
        }
    }

    /** Update Reservation */
    public function update(Request $request, Reservation $reservation)
    {
        $this->validateRequest($request);

        try {
            DB::beginTransaction();

            $approvers = $this->fetchApprovers($request['approvers']);
            $this->validateDateRange($request['start_date'], $request['end_date']);

            $this->updateResource($reservation, 'vehicle_id', Vehicle::class, 'vehicle_name', $request['vehicle_name']);
            $this->updateResource($reservation, 'driver_id', Driver::class, 'fullname', $request['driver_name']);
            $this->updateResource($reservation, 'mine_id', Mine::class, 'mine_name', $request['mine_name']);

            $reservation->fill($request->only(['destination', 'start_date', 'end_date']))->save();
            $this->syncApprovers($approvers, $reservation);

            $this->logSvc->create("memperbarui data pemesanan kendaraan {$reservation->vehicle->vehicle_name}");

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->handleException($e, "Failed to update reservation");
        }
    }

    /** ---------- Helper Methods ---------- */

    private function isApprover()
    {
        return auth()->user()->load('role')->role->role_name === "Approver";
    }

    private function resolveStatus($approvals)
    {
        if ($approvals->contains('status', 'Rejected')) {
            return "Rejected";
        }

        return $approvals->every('status', 'Approved') ? "Approved" : "Pending";
    }

    private function validateRequest(Request $request)
    {
        if (!isset($request['approvers']) || count($request['approvers']) < 2) {
            throw new ServiceException("Minimal memperlukan 2 pihak penyetuju");
        }
    }

    private function validateDateRange($start, $end)
    {
        if (Carbon::parse($start)->greaterThan(Carbon::parse($end))) {
            throw new ServiceException("Tanggal selesai seharusnya lebih lama dibandingkan tanggal mulai");
        }
    }

    private function fetchResource($model, $field, $value)
    {
        $resource = Amp\async(fn() => $model::where($field, '=', $value)->first())->await();

        if (!$resource) {
            throw new ServiceException(ucfirst($field) . " tidak dapat ditemukan");
        }

        return $resource;
    }

    private function fetchApprovers(array $approvers)
    {
        $users = Amp\async(fn() => User::whereIn('fullname', $approvers)->get())->await();

        if ($users->isEmpty()) {
            throw new ServiceException("Pihak penyetuju tidak dapat ditemukan");
        }

        return $users;
    }

    private function createApprovals($approvers, $reservation)
    {
        foreach ($approvers as $user) {
            Approval::create([
                'reservation_id' => $reservation->reservation_id,
                'approver_id'    => $user->user_id,
                'status'         => 'Pending',
                'comments'       => ''
            ]);
        }
    }

    private function updateResource($reservation, $field, $model, $resourceField, $requestValue)
    {
        if ($reservation->$field != $requestValue) {
            $resource = $this->fetchResource($model, $resourceField, $requestValue);
            $reservation->$field = $resource->$field;
        }
    }

    private function syncApprovers($approvers, $reservation)
    {
        $existingApprovers = $reservation->approvals->pluck('approver_id')->toArray();

        foreach ($approvers as $user) {
            if (!in_array($user->user_id, $existingApprovers)) {
                Approval::create([
                    'reservation_id' => $reservation->reservation_id,
                    'approver_id'    => $user->user_id,
                    'status'         => 'Pending',
                    'comments'       => ''
                ]);
            }
        }

        foreach ($reservation->approvals as $approval) {
            if (!$approvers->contains('user_id', $approval->approver_id)) {
                $approval->delete();
            }
        }
    }

    private function handleException(Exception $e, $message)
    {
        if (!($e instanceof ServiceException)) {
            error_log("ReservationService: " . $e->getMessage());
            throw new Exception($message);
        }

        throw $e;
    }
}
