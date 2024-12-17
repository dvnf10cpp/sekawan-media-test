<x-app-layout>
  <div class="tw-rounded-lg tw-mx-5 tw-p-4 tw-bg-gray-900 tw-min-h-screen">
    <!-- Header -->
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-items-center tw-my-2">
        <h1 class="tw-text-2xl lg:tw-text-3xl tw-font-semibold tw-text-white">List Pengemudi</h1>
        @if(auth()->user()->load('role')->role->role_name === "Admin")
        <a href="{{ route('drivers.pages.create') }}"
           class="tw-bg-orange-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg hover:tw-bg-orange-600">Tambah</a>
        @endif
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700"></div>
    </div>

    <!-- Table -->
    <div class="tw-bg-gray-800 tw-rounded-lg tw-shadow-lg tw-overflow-hidden">
      <table class="tw-w-full">
        <thead>
          <tr class="tw-bg-blue-600">
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">No</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Nama Lengkap</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Nomor HP</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Email</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold tw-text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($drivers as $driver)
          <tr class="tw-border-b tw-border-gray-700 hover:tw-bg-gray-700">
            <td class="tw-py-3 tw-px-4 tw-text-center tw-text-gray-300">{{ $loop->iteration }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $driver->fullname }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $driver->phone_number }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $driver->email }}</td>
            <td class="tw-py-3 tw-px-4 tw-flex tw-justify-center tw-gap-2">
              <a href="{{ route('drivers.pages.edit', $driver) }}" class="tw-bg-orange-500 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-orange-600">Edit</a>
              <form action="{{ route('drivers.destroy', $driver) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="tw-bg-red-600 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-red-700">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="tw-mt-4 tw-flex tw-justify-center">
      {!! $drivers->links() !!}
    </div>
  </div>
</x-app-layout>
