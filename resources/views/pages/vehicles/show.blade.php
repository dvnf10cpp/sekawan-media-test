<x-app-layout>
  <div class="tw-container tw-mx-auto tw-p-6 tw-bg-gray-900 tw-rounded-lg tw-shadow-lg">
    <!-- Page Header -->
    <div class="tw-mb-6">
      <div class="tw-flex tw-justify-between tw-items-center">
        <h1 class="tw-text-3xl tw-font-bold tw-text-white">Kendaraan: {{ $vehicle->vehicle_name }}</h1>
      </div>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-my-4"></div>
    </div>

    <!-- Vehicle Details Card -->
    <div class="tw-bg-gray-800 tw-rounded-lg tw-shadow-inner tw-py-5 tw-px-6 tw-mb-6">
      <table class="tw-w-full tw-text-gray-300">
        <tbody>
          <tr>
            <td class="tw-py-2 tw-text-lg tw-w-1/4">Nama Kendaraan</td>
            <td class="tw-py-2 tw-text-lg">: {{ $vehicle->vehicle_name }}</td>
          </tr>
          <tr>
            <td class="tw-py-2 tw-text-lg tw-w-1/4">Tipe Kendaraan</td>
            <td class="tw-py-2 tw-text-lg">: {{ $vehicle->vehicle_type }}</td>
          </tr>
          <tr>
            <td class="tw-py-2 tw-text-lg tw-w-1/4">Pemilik Kendaraan</td>
            <td class="tw-py-2 tw-text-lg">: {{ $vehicle->vehicle_owner }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Riwayat Reservasi Section -->
    <div class="tw-mb-6">
      <h1 class="tw-text-2xl tw-font-semibold tw-text-white">Riwayat Reservasi</h1>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-my-3"></div>
    </div>

    <!-- Reservation Table -->
    <div class="tw-overflow-x-auto">
      <table class="tw-w-full tw-bg-gray-800 tw-rounded-lg tw-shadow-lg">
        <thead>
          <tr class="tw-bg-gray-700 tw-text-gray-100">
            <th class="tw-py-2 tw-px-4 tw-text-center">No</th>
            <th class="tw-py-2 tw-px-4">Nama Kendaraan</th>
            <th class="tw-py-2 tw-px-4">Nama Pengemudi</th>
            <th class="tw-py-2 tw-px-4">Tujuan</th>
            <th class="tw-py-2 tw-px-4">Biaya Bensin</th>
            <th class="tw-py-2 tw-px-4">Tanggal Mulai</th>
            <th class="tw-py-2 tw-px-4">Tanggal Selesai</th>
            <th class="tw-py-2 tw-px-4 tw-text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($vehicle->reservations as $reservation)
          <tr class="tw-border-b tw-border-gray-700 odd:tw-bg-gray-700 even:tw-bg-gray-600 hover:tw-bg-gray-500 tw-text-gray-200">
            <td class="tw-py-2 tw-text-center">{{ $loop->iteration }}</td>
            <td class="tw-py-2 tw-px-4">{{ $reservation->vehicle->vehicle_name }}</td>
            <td class="tw-py-2 tw-px-4">{{ $reservation->driver_name }}</td>
            <td class="tw-py-2 tw-px-4">{{ $reservation->destination }}</td>
            <td class="tw-py-2 tw-px-4">{{ $reservation->fuel_cost }}</td>
            <td class="tw-py-2 tw-px-4">{{ $reservation->start_date }}</td>
            <td class="tw-py-2 tw-px-4">{{ $reservation->end_date }}</td>
            <td class="tw-py-2 tw-flex tw-justify-center tw-space-x-2">
              <a href="{{ route('reservations.pages.show', $reservation) }}" class="tw-bg-blue-600 tw-text-white tw-py-1 tw-px-3 tw-rounded-md hover:tw-bg-blue-500 tw-transition-all">Detail</a>
              @if(auth()->user()->load('role')->role->role_name === "Admin")
              <a href="{{ route('reservations.pages.edit', $reservation) }}" class="tw-bg-yellow-500 tw-text-white tw-py-1 tw-px-3 tw-rounded-md hover:tw-bg-yellow-400 tw-transition-all">Edit</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
