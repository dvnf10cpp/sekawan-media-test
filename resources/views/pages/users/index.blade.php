<x-app-layout>
  <div class="tw-mx-5 tw-p-4 tw-rounded-lg tw-bg-gray-900 tw-min-h-screen">
    <!-- Header Section -->
    <div class="tw-w-full tw-mb-5">
      <div class="tw-flex tw-justify-between tw-items-center tw-my-2">
        <h1 class="tw-text-2xl lg:tw-text-3xl tw-font-semibold tw-text-white">List Pengguna</h1>
      </div>
      <x-alert />
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700"></div>
    </div>

    <!-- Table Section -->
    <div class="tw-rounded-lg tw-shadow-lg tw-overflow-hidden tw-bg-gray-800">
      <table class="tw-w-full">
        <!-- Table Header -->
        <thead>
          <tr class="tw-bg-blue-500">
            <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center tw-font-semibold">No</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Nama Lengkap</th>
            <th class="tw-py-3 tw-px-4 tw-text-white tw-font-semibold">Role</th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody>
          @foreach($users as $user)
          <tr class="tw-border-b tw-border-gray-700 hover:tw-bg-gray-700">
            <td class="tw-py-3 tw-px-4 tw-text-center tw-text-gray-300">{{ $loop->iteration }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $user->fullname }}</td>
            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $user->role->role_name }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="tw-mt-4 tw-flex tw-justify-center">
      {!! $users->links() !!}
    </div>
  </div>
</x-app-layout>
