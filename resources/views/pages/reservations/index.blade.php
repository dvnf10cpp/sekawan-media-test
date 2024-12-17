<x-app-layout>
  <div class="tw-rounded-lg tw-mx-5 tw-p-4 tw-bg-gray-900 tw-min-h-screen">
    <!-- Header Section -->
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-items-center tw-my-2">
        <h1 class="tw-text-2xl lg:tw-text-3xl tw-font-semibold tw-text-white">List Reservasi</h1>
        <div>
          @if(auth()->user()->load('role')->role->role_name == "Approver")
          <a href="{{ route('reservations.pages.index', ['status' => 'Approved']) }}"
             class="tw-px-4 tw-py-2 tw-rounded tw-text-white {{ request('status') === 'Approved' ? 'tw-border tw-border-blue-500 tw-text-blue-500' : 'tw-bg-blue-600 hover:tw-bg-blue-700' }}">Disetujui</a>
          <a href="{{ route('reservations.pages.index', ['status' => 'Rejected']) }}"
             class="tw-px-4 tw-py-2 tw-rounded tw-text-white {{ request('status') === 'Rejected' ? 'tw-border tw-border-red-500 tw-text-red-500' : 'tw-bg-red-600 hover:tw-bg-red-700' }}">Ditolak</a>
          <a href="{{ route('reservations.pages.index', ['status' => 'Pending']) }}"
             class="tw-px-4 tw-py-2 tw-rounded tw-text-white {{ request('status') === 'Pending' ? 'tw-border tw-border-yellow-500 tw-text-yellow-500' : 'tw-bg-yellow-500 hover:tw-bg-yellow-600' }}">Menunggu</a>
          @else
          <a class="tw-px-4 tw-py-2 tw-rounded tw-bg-blue-600 tw-text-white hover:tw-bg-blue-700"
             target="_blank" href="{{ route('reservations.request.export.excel') }}">Export Excel</a>
          <a href="{{ route('reservations.pages.create') }}"
             class="tw-px-4 tw-py-2 tw-rounded tw-bg-orange-500 tw-text-white hover:tw-bg-orange-600">Tambah</a>
          @endif
        </div>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700"></div>
    </div>

    <!-- Table Section -->
    <div class="tw-rounded-lg tw-shadow-lg tw-overflow-hidden tw-bg-gray-800">
      <table class="tw-w-full">
        <!-- Table Header -->
        <thead>
          <tr class="tw-bg-blue-600">
            <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center">No</th>
            <th class="tw-py-3 tw-px-4 tw-text-white">Nama Kendaraan</th>
            <th class="tw-py-3 tw-px-4 tw-text-white">Nama Pengemudi</th>
            <th class="tw-py-3 tw-px-4 tw-text-white">Tujuan</th>
            <th class="tw-py-3 tw-px-4 tw-text-white">Tanggal Mulai</th>
            <th class="tw-py-3 tw-px-4 tw-text-white">Tanggal Selesai</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center">Status</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center">Aksi</th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody>
          @foreach($reservations as $reservation)
          <tr class="tw-border-b tw-border-gray-700 hover:tw-bg-gray-700">
            <td class="tw-py-3 tw-px-4 tw-text-center tw-text-gray-300">{{ $loop->iteration }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $reservation->vehicle->vehicle_name }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">
              <a href="">{{ $reservation->driver->fullname }}</a>
            </td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">
              <a href="">{{ $reservation->mine->mine_name }}</a>
            </td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $reservation->start_date }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $reservation->end_date }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-center">
              <span class="tw-py-1 tw-px-3 tw-rounded-md tw-text-white
                {{ $reservation->status == 'Approved' ? 'tw-bg-blue-500' : '' }}
                {{ $reservation->status == 'Pending' ? 'tw-bg-yellow-500' : '' }}
                {{ $reservation->status == 'Rejected' ? 'tw-bg-red-500' : '' }}">
                {{ $reservation->status }}
              </span>
            </td>
            <td class="tw-py-3 tw-px-4 tw-flex tw-justify-center tw-gap-2">
              <a href="{{ route('reservations.pages.show', $reservation) }}"
                 class="tw-bg-blue-600 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-blue-700">Detail</a>
              @if(auth()->user()->load('role')->role->role_name === "Admin")
              <a href="{{ route('reservations.pages.edit', $reservation) }}"
                 class="tw-bg-orange-500 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-orange-600">Edit</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="tw-mt-4 tw-flex tw-justify-center tw-gap-x-10">
      {!! $reservations->links() !!}
    </div>
  </div>
</x-app-layout>
