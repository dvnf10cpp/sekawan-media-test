<x-app-layout>
  <div class="tw-container tw-mx-auto tw-p-6 tw-bg-gray-900 tw-rounded-lg tw-shadow-lg">
    <!-- Page Header -->
    <div class="tw-w-full tw-mb-6">
      <div class="tw-flex tw-justify-between tw-items-center">
        <h1 class="tw-text-3xl tw-font-bold tw-text-white">Tambah Kendaraan</h1>
      </div>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700"></div>
    </div>

    <!-- Form Section -->
    <form action="{{ route('vehicles.request.store') }}" method="POST" class="tw-bg-gray-800 tw-rounded-lg tw-px-6 lg:tw-px-8 tw-py-5 tw-shadow-inner">
      @csrf

      <!-- Input Field: Nama Kendaraan -->
      <x-input
        type="text"
        name="Nama Kendaraan"
        id="vehicle_name"
        required
        placeholder="Masukkan nama kendaraan"
        value="{{ old('vehicle_name') }}"
      />

      <!-- Select Field: Tipe Kendaraan -->
      <div class="tw-mb-4">
        <label for="vehicle_type" class="tw-block tw-mb-2 lg:tw-text-lg tw-text-gray-300">Tipe Kendaraan</label>
        <select name="vehicle_type" id="vehicle_type" class="tw-w-full tw-py-2 tw-px-4 tw-border tw-border-gray-600 tw-rounded-md tw-bg-gray-700 tw-text-gray-200 focus:tw-border-blue-500 focus:tw-outline-none hover:tw-border-gray-400" required>
          <option value="" class="tw-text-gray-400">Pilih Tipe Kendaraan</option>
          <option value="Person" {{ old('vehicle_type') == 'Person' ? 'selected' : '' }}>Person</option>
          <option value="Cargo" {{ old('vehicle_type') == 'Cargo' ? 'selected' : '' }}>Cargo</option>
        </select>
      </div>

      <!-- Select Field: Pemilik Kendaraan -->
      <div class="tw-mb-4">
        <label for="vehicle_owner" class="tw-block tw-mb-2 lg:tw-text-lg tw-text-gray-300">Pemilik Kendaraan</label>
        <select name="vehicle_owner" id="vehicle_owner" class="tw-w-full tw-py-2 tw-px-4 tw-border tw-border-gray-600 tw-rounded-md tw-bg-gray-700 tw-text-gray-200 focus:tw-border-blue-500 focus:tw-outline-none hover:tw-border-gray-400" required>
          <option value="" class="tw-text-gray-400">Pilih Pemilik Kendaraan</option>
          <option value="Company" {{ old('vehicle_owner') == 'Company' ? 'selected' : '' }}>Company</option>
          <option value="Rental" {{ old('vehicle_owner') == 'Rental' ? 'selected' : '' }}>Rental</option>
        </select>
      </div>

      <!-- Submit Button -->
      <div class="tw-mt-6">
        <button type="submit" class="tw-w-full tw-bg-blue-600 tw-text-white tw-py-2 tw-rounded-md hover:tw-bg-blue-500 tw-duration-300 tw-ease-in-out">
          Tambah Kendaraan
        </button>
      </div>

      <x-alert />
    </form>
  </div>
</x-app-layout>
