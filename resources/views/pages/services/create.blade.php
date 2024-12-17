<x-app-layout>
  <div class="tw-container tw-mx-auto tw-p-6 tw-bg-gray-900 tw-rounded-lg tw-shadow-lg">
    <h1 class="tw-text-3xl tw-font-bold tw-text-white tw-mb-6">Tambah Servis Kendaraan</h1>

    <form action="{{ route('services.request.store') }}" method="POST" class="tw-bg-gray-800 tw-rounded-lg tw-p-6">
      @csrf

      <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-300">Kendaraan</label>
        <select name="vehicle_name" class="tw-w-full tw-bg-gray-700 tw-text-white tw-p-2 tw-rounded" required>
          <option value="" hidden>Pilih Kendaraan</option>
          @foreach($vehicles as $vehicle)
          <option value="{{ $vehicle->vehicle_name }}">{{ $vehicle->vehicle_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-300">Tanggal Layanan</label>
        <input type="date" name="service_date" class="tw-w-full tw-bg-gray-700 tw-text-white tw-p-2 tw-rounded" required />
      </div>

      <div class="tw-mb-4">
        <label class="tw-block tw-text-gray-300">Deskripsi</label>
        <textarea name="service_description" rows="4" class="tw-w-full tw-bg-gray-700 tw-text-white tw-p-2 tw-rounded"></textarea>
      </div>

      <button type="submit" class="tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded hover:tw-bg-blue-700">
        Simpan
      </button>
    </form>
  </div>
</x-app-layout>
