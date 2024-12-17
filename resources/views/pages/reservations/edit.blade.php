<x-app-layout>
  <div class="tw-container tw-mx-auto tw-p-6 tw-bg-gray-900 tw-rounded-lg tw-shadow-lg">
    <!-- Page Header -->
    <div class="tw-mb-6">
      <div class="tw-flex tw-justify-between tw-items-center">
        <h1 class="tw-text-3xl tw-font-bold tw-text-white">Perbarui Data Reservasi</h1>
      </div>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-my-4"></div>
    </div>

    <!-- Reservation Update Form -->
    <form
      action="{{ route('reservations.request.update', $reservation) }}"
      method="POST"
      class="tw-bg-gray-800 tw-rounded-lg tw-p-6 tw-shadow-inner"
    >
      @csrf
      @method("PUT")


      <div class="tw-mb-4">
        <label for="driver_name" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">Pengemudi <span class="tw-text-red-500">*</span></label>
        <select
          name="driver_name"
          id="driver_name"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        >
        <option value="{{ $reservation->driver->fullname }}" selected>
          {{ $reservation->driver->fullname }}
        </option>
          @foreach($drivers as $driver)
          <option value="{{ $driver->fullname }}">{{ $driver->fullname }}</option>
          @endforeach
        </select>
      </div>


      <!-- Input: Tipe Kendaraan -->
      <div class="tw-mb-4">
        <label for="vehicle_name" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">Kendaraan <span class="tw-text-red-500">*</span></label>
        <select
          name="vehicle_name"
          id="vehicle_name"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        >
        <option value="{{ $reservation->vehicle->vehicle_name }}" selected>
          {{ $reservation->vehicle->vehicle_name }}
        </option>
          @foreach($vehicles as $vehicle)
          <option value="{{ $vehicle->vehicle_name }}">{{ $vehicle->vehicle_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="tw-mb-4">
        <label for="mine_name" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">Tempat Tambang <span class="tw-text-red-500">*</span></label>
        <select
          name="mine_name"
          id="mine_name"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        >
        <option value="{{ $reservation->mine->mine_name }}" selected>
          {{ $reservation->mine->mine_name }}
        </option>
          @foreach($mines as $mine)
          <option value="{{ $mine->mine_name }}">{{ $mine->mine_name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Input: Tanggal Mulai dan Selesai -->
      <div class="tw-flex tw-mb-4">
        <div class="tw-w-1/2 tw-mr-2">
          <label for="start_date" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">
            Tanggal Mulai <span class="tw-text-red-500">*</span>
          </label>
          <input
            type="date"
            id="start_date"
            name="start_date"
            value="{{ $reservation->start_date }}"
            class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
            required
          />
        </div>
        <div class="tw-w-1/2 tw-ml-2">
          <label for="end_date" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">
            Tanggal Selesai <span class="tw-text-red-500">*</span>
          </label>
          <input
            type="date"
            id="end_date"
            name="end_date"
            value="{{ $reservation->end_date }}"
            class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
            required
          />
        </div>
      </div>

      <!-- Checkboxes: Nama Penyetuju -->
      <div class="tw-mb-4">
        <label for="approvers" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">
          Pihak Penyetuju <span class="tw-text-red-500">*</span>
        </label>
        <div
          class="tw-h-32 tw-overflow-y-auto tw-border tw-border-gray-600 tw-rounded-md tw-bg-gray-700 tw-p-2"
        >
          @foreach($users as $user)
            <div class="tw-mb-2">
              <label class="tw-inline-flex tw-items-center tw-text-gray-200">
                <input
                  type="checkbox"
                  name="approvers[]"
                  value="{{ $user->fullname }}"
                  class="tw-mr-2 tw-form-checkbox tw-text-secondary focus:tw-ring-secondary"
                  @if($reservation->approvals->contains('approver_id', $user->user_id)) checked @endif
                />
                {{ $user->fullname }}
              </label>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Submit Button -->
      <div>
        <button
          type="submit"
          class="tw-w-full tw-bg-secondary tw-text-white tw-py-2 tw-rounded-md hover:tw-bg-white hover:tw-text-secondary tw-border tw-border-secondary tw-transition-all"
        >
          Perbarui Pemesanan
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
