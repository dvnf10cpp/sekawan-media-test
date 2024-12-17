<x-app-layout>
  <div class="tw-mx-5 tw-p-6 tw-bg-gray-900 tw-min-h-screen tw-rounded-lg tw-shadow-lg">
    <!-- Page Header -->
    <div class="tw-mb-5 tw-flex tw-justify-between tw-items-center">
      <h1 class="tw-text-3xl tw-font-bold tw-text-white">Log Aplikasi</h1>
    </div>

    <x-alert />

    <!-- Divider -->
    <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-mb-5"></div>

    <!-- Table Section -->
    <div class="tw-overflow-x-auto tw-rounded-lg tw-shadow-inner tw-bg-gray-800">
      <table class="tw-w-full tw-table-auto tw-border-collapse">
        <!-- Table Header -->
        <thead>
          <tr class="tw-bg-blue-600">
            <th class="tw-py-4 tw-px-6 tw-text-white tw-font-semibold tw-text-center">No</th>
            <th class="tw-py-4 tw-px-6 tw-text-white tw-font-semibold">Nama Pengguna</th>
            <th class="tw-py-4 tw-px-6 tw-text-white tw-font-semibold">Aksi</th>
            <th class="tw-py-4 tw-px-6 tw-text-white tw-font-semibold">Waktu</th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody>
          @foreach($logs as $log)
          <tr class="tw-border-b tw-border-gray-700 odd:tw-bg-gray-700 even:tw-bg-gray-800 hover:tw-bg-gray-600">
            <td class="tw-py-4 tw-px-6 tw-text-center tw-text-gray-300">{{ $loop->iteration }}</td>
            <td class="tw-py-4 tw-px-6 tw-text-gray-300">{{ $log->user->fullname }}</td>
            <td class="tw-py-4 tw-px-6 tw-text-gray-300">{{ $log->action }}</td>
            <td class="tw-py-4 tw-px-6 tw-text-gray-300">{{ $log->created_at }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="tw-mt-6 tw-flex tw-justify-center">
      {!! $logs->links() !!}
    </div>
  </div>
</x-app-layout>
