<x-app-layout>
  <div class="tw-container tw-mx-auto tw-p-6 tw-bg-gray-900 tw-rounded-lg tw-shadow-lg">
    <!-- Page Header -->
    <div class="tw-mb-6">
      <h1 class="tw-text-3xl tw-font-bold tw-text-white">Add Fuel Consumption Record</h1>
      <div class="tw-w-full tw-h-[1px] tw-bg-gray-700 tw-my-4"></div>
    </div>

    <!-- Fuel Consumption Form -->
    <form
      action="{{ route('fuel.request.store') }}"
      method="POST"
      class="tw-bg-gray-800 tw-rounded-lg tw-p-6 tw-shadow-inner"
    >
      @csrf

      <!-- Dropdown: Vehicle -->
      <div class="tw-mb-4">
        <label for="vehicle_id" class="tw-block tw-mb-2 tw-text-gray-300">Vehicle <span class="tw-text-red-500">*</span></label>
        <select
          name="vehicle_id"
          id="vehicle_id"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        >
          <option value="" hidden>Select Vehicle</option>
          @foreach($vehicles as $vehicle)
          <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->vehicle_name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Dropdown: Fuel Type -->
      <div class="tw-mb-4">
        <label for="fuel_type" class="tw-block tw-mb-2 tw-text-gray-300">Fuel Type <span class="tw-text-red-500">*</span></label>
        <select
          name="fuel_type"
          id="fuel_type"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        >
          <option value="" hidden>Select Fuel Type</option>
          <option value="Diesel">Diesel</option>
          <option value="Petrol">Petrol</option>
          <option value="Gasoline">Gasoline</option>
        </select>
      </div>

      <!-- Input: Fuel Liters -->
      <div class="tw-mb-4">
        <label for="fuel_liters" class="tw-block tw-mb-2 tw-text-gray-300">Liters Consumed <span class="tw-text-red-500">*</span></label>
        <input
          type="number"
          step="0.01"
          name="fuel_liters"
          id="fuel_liters"
          value="{{ old('fuel_liters') }}"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        />
      </div>

      <!-- Input: Fuel Date -->
      <div class="tw-mb-4">
        <label for="fuel_date" class="tw-block tw-mb-2 tw-text-gray-300">Date <span class="tw-text-red-500">*</span></label>
        <input
          type="date"
          name="fuel_date"
          id="fuel_date"
          value="{{ old('fuel_date') }}"
          class="tw-w-full tw-p-2 tw-border tw-rounded-md tw-bg-gray-700 tw-text-white focus:tw-border-secondary"
          required
        />
      </div>

      <!-- Submit Button -->
      <div class="tw-mb-4">
        <button
          type="submit"
          class="tw-w-full tw-bg-green-600 tw-text-white tw-py-2 tw-rounded-md hover:tw-bg-green-700"
        >
          Add Record
        </button>
      </div>
    </form>
  </div>
</x-app-layout>