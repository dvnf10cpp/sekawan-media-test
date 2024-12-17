<x-app-layout>
  <div class="tw-container tw-mx-auto tw-p-6 tw-bg-gray-900 tw-rounded-lg tw-shadow-lg">
    <!-- Page Header -->
    <div class="tw-mb-6">
      <div class="tw-flex tw-justify-between tw-items-center">
        <h1 class="tw-text-3xl tw-font-bold tw-text-white">Buat Reservasi</h1>
      </div>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-my-4"></div>
    </div>

    <!-- Reservation Form -->
    <form
      action="{{ route('reservations.request.store') }}"
      method="POST"
      class="tw-bg-gray-800 tw-rounded-lg tw-p-6 tw-shadow-inner"
    >
      @csrf


      <div class="tw-mb-4">
        <label for="driver_name" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">Pengemudi <span class="tw-text-red-500">*</span></label>
        <select
          name="driver_name"
          id="driver_name"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        >
          @if(old('driver_name'))
          <option value="{{ old('driver_name') }}" class="tw-hidden">{{ old('driver_name') }}</option>
          @else
          <option value="" hidden class="tw-hidden">Pilih Pengemudi</option>
          @endif
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
          @if(old('vehicle_name'))
          <option value="{{ old('vehicle_name') }}" class="tw-hidden">{{ old('vehicle_name') }}</option>
          @else
          <option value="" hidden class="tw-hidden">Pilih Kendaraan</option>
          @endif
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
          @if(old('mine_name'))
          <option value="{{ old('mine_name') }}" class="tw-hidden">{{ old('mine_name') }}</option>
          @else
          <option value="" class="tw-hidden">Pilih Tempat Tambang</option>
          @endif
          @foreach($mines as $mine)
          <option value="{{ $mine->mine_name }}">{{ $mine->mine_name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Input: Tanggal Mulai dan Selesai -->
      <div class="tw-flex tw-mb-4">
        <div class="tw-w-1/2 tw-mr-2">
          <label for="start_date" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">Tanggal Mulai <span class="tw-text-red-500">*</span></label>
          <input
          type="date"
          id="start_date"
          name="start_date"
          value="{{ old('start_date') }}"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        />
      </div>
      <div class="tw-w-1/2 tw-ml-2">
        <label for="end_date" class="tw-block tw-mb-2 tw-text-gray-300 lg:tw-text-lg">Tanggal Selesai <span class="tw-text-red-500">*</span></label>
        <input
          type="date"
          id="end_date"
          name="end_date"
          value="{{ old('end_date') }}"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        />
      </div>
    </div>

    <!-- Input: Pihak Penyetuju (Multiselect) -->
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
                class="tw-mr-2 tw-form-radio tw-text-secondary focus:tw-ring-secondary"
              />
              {{ $user->fullname }}
            </label>
          </div>
        @endforeach
      </div>
    </div>


    <!-- Submit Button -->
    <div class="tw-mb-4">
      <button
        type="submit"
        class="tw-w-full tw-bg-secondary tw-text-white tw-py-2 tw-rounded-md hover:tw-bg-white hover:tw-text-secondary tw-transition-all"
      >
        Buat Pemesanan
      </button>
    </div>
    <x-alert/>
  </form>
</div>
</x-app-layout>
