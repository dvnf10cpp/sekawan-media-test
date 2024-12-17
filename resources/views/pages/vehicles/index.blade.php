<x-app-layout>
  <div class="tw-rounded-lg tw-mx-5 tw-p-4 tw-bg-gray-900 tw-min-h-screen">
    <!-- Header Section -->
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-items-center tw-my-2">
        <h1 class="tw-text-2xl lg:tw-text-3xl tw-font-semibold tw-text-white">List Kendaraan</h1>
        @if(auth()->user()->load('role')->role->role_name === "Admin")
        <a href="{{ route('vehicles.pages.create') }}"
           class="tw-bg-orange-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg hover:tw-bg-orange-600">Tambah</a>
        @endif
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
            <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center tw-font-semibold">No</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Nama Kendaraan</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Nomor Plat</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Tipe Kendaraan</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Pemilik Kendaraan</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center tw-font-semibold">Aksi</th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody>
          @foreach($vehicles as $vehicle)
          <tr class="tw-border-b tw-border-gray-700 hover:tw-bg-gray-700">
            <td class="tw-py-3 tw-px-4 tw-text-center tw-text-gray-300">{{ $loop->iteration }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $vehicle['vehicle_name'] }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $vehicle['number_plate'] }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $vehicle['vehicle_type'] }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $vehicle['vehicle_owner'] }}</td>
            <td class="tw-py-3 tw-px-4 tw-flex tw-justify-center tw-gap-2">
              <a href="{{ route('vehicles.pages.show', $vehicle) }}"
                 class="tw-bg-blue-600 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-blue-700">Riwayat</a>
              @if(auth()->user()->load('role')->role->role_name === "Admin")
              <a href="{{ route('vehicles.pages.edit', $vehicle) }}"
                 class="tw-bg-orange-500 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-orange-600">Edit</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="tw-mt-4 tw-flex tw-justify-center">
      {!! $vehicles->links() !!}
    </div>
  </div>
</x-app-layout>
