<x-app-layout>
  <div class="tw-container tw-mx-auto tw-p-6 tw-bg-gray-900 tw-rounded-lg tw-shadow-lg">
    <!-- Page Header -->
    <div class="tw-mb-6">
      <div class="tw-flex tw-justify-between tw-items-center">
        <h1 class="tw-text-3xl tw-font-bold tw-text-white">Pemesanan #{{ $reservation->reservation_id }}</h1>
      </div>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-my-4"></div>
    </div>

    <!-- Reservation Details -->
    <div class="tw-bg-gray-800 tw-rounded-lg tw-p-6 tw-shadow-inner tw-mb-6">
      <table class="tw-w-full">
        <tbody>
          <tr>
            <td class="tw-text-gray-300 tw-font-semibold lg:tw-text-lg tw-w-1/3">Nama Pengemudi</td>
            <td class="tw-text-white lg:tw-text-lg">: {{ $reservation->driver->fullname }}</td>
          </tr>
          <tr>
            <td class="tw-text-gray-300 tw-font-semibold lg:tw-text-lg tw-w-1/3">Nama Pengaju</td>
            <td class="tw-text-white lg:tw-text-lg">: {{ $reservation->admin->fullname }}</td>
          </tr>
          <tr>
            <td class="tw-text-gray-300 tw-font-semibold lg:tw-text-lg tw-w-1/3">Tempat Tambang</td>
            <td class="tw-text-white lg:tw-text-lg">: {{ $reservation->mine->mine_name }}</td>
          </tr>
          <tr>
            <td class="tw-text-gray-300 tw-font-semibold lg:tw-text-lg tw-w-1/3">Tanggal Mulai</td>
            <td class="tw-text-white lg:tw-text-lg">: {{ $reservation->start_date }}</td>
          </tr>
          <tr>
            <td class="tw-text-gray-300 tw-font-semibold lg:tw-text-lg tw-w-1/3">Tanggal Selesai</td>
            <td class="tw-text-white lg:tw-text-lg">: {{ $reservation->end_date }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Buttons -->
    <div class="tw-flex tw-space-x-4 tw-mb-6">
      <div class="tw-w-1/2">
        <button
          class="tw-w-full tw-py-2 tw-rounded-md tw-text-white
          {{ $reservation->status == 'Approved' ? 'tw-bg-green-500 hover:tw-bg-green-600' : '' }}
          {{ $reservation->status == 'Pending' ? 'tw-bg-yellow-500 hover:tw-bg-yellow-600' : '' }}
          {{ $reservation->status == 'Rejected' ? 'tw-bg-red-500 hover:tw-bg-red-600' : '' }}"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#finishBackdrop"
        >
          {{ $reservation->status }}
        </button>
      </div>
      <div class="tw-w-1/2">
        @if(auth()->user()->load('role')->role->role_name === 'Admin')
          <a
            href="{{ route('reservations.pages.edit', $reservation) }}"
            class="tw-w-full tw-inline-block tw-text-center tw-py-2 tw-rounded-md tw-bg-secondary tw-text-white hover:tw-bg-white hover:tw-text-secondary tw-transition-all"
          >
            Edit Pemesanan
          </a>
        @else
          @if($reservation->approvals->firstWhere('approver_id', auth()->user()->user_id))
            <button
              type="button"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
              class="tw-w-full tw-py-2 tw-rounded-md tw-bg-primary hover:tw-bg-blue-600 tw-text-white"
            >
              Persetujuan
            </button>
          @else
            <button class="tw-w-full tw-py-2 tw-rounded-md tw-bg-gray-600 tw-text-gray-400" disabled>Persetujuan</button>
          @endif
        @endif
      </div>
    </div>

    <!-- Approvers Table -->
    <div class="tw-mb-6">
      <h2 class="tw-text-2xl tw-font-bold tw-text-white tw-mb-4">Pihak Penyetuju</h2>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-mb-4"></div>
      <table class="tw-w-full">
        <thead>
          <tr class="tw-bg-gray-700">
            <th class="tw-py-2 tw-text-white tw-text-center">No</th>
            <th class="tw-py-2 tw-text-white">Nama Pihak Penyetuju</th>
            <th class="tw-py-2 tw-text-white tw-text-center">Status</th>
            <th class="tw-py-2 tw-text-white">Waktu Aksi</th>
            <th class="tw-py-2 tw-text-white">Komen</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reservation->approvals as $approval)
            <tr class="tw-border-b tw-border-gray-600">
              <td class="tw-py-2 tw-text-center tw-text-gray-300">{{ $loop->iteration }}</td>
              <td class="tw-py-2 tw-text-white">{{ $approval->approver->fullname }}</td>
              <td class="tw-py-2 tw-text-center">
                <span class="tw-inline-block tw-px-2 tw-py-1 tw-rounded-md tw-text-white
                {{ $approval->status == 'Approved' ? 'tw-bg-green-500' : '' }}
                {{ $approval->status == 'Pending' ? 'tw-bg-yellow-500' : '' }}
                {{ $approval->status == 'Rejected' ? 'tw-bg-red-500' : '' }}">
                  {{ $approval->status }}
                </span>
              </td>
              <td class="tw-py-2 tw-text-gray-300">{{ $approval->updated_at }}</td>
              <td class="tw-py-2 tw-text-gray-300">{{ $approval->comments }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Approval Modal -->
    @if(auth()->user()->load('role')->role->role_name === 'Approver' && $reservation->approvals->firstWhere('approver_id', auth()->user()->user_id))
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content tw-bg-gray-800 tw-text-white">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Persetujuan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('approvals.request.update', $reservation) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="tw-mb-4">
                  <label for="status" class="tw-block tw-text-lg">Status</label>
                  <select name="status" id="status" class="tw-w-full tw-rounded-md tw-bg-gray-700 tw-border-gray-600 tw-text-white" required>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Pending">Pending</option>
                  </select>
                </div>
                <div class="tw-mb-4">
                  <label for="comments" class="tw-block tw-text-lg">Komen</label>
                  <textarea name="comments" id="comments" rows="4" class="tw-w-full tw-resize-none tw-rounded-md tw-bg-gray-700 tw-border-gray-600 tw-text-white"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
</x-app-layout>
