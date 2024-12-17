<x-app-layout>
  <div class="tw-mx-5 tw-p-4 tw-bg-gray-900 tw-rounded-lg">
    <h1 class="tw-text-3xl tw-text-white tw-font-bold">Fuel Consumptions</h1>
    <div class="tw-mt-4">
      <a href="{{ route('fuel.pages.create') }}" class="tw-bg-green-500 tw-text-white tw-px-4 tw-py-2 tw-rounded">
        Add New Fuel Record
      </a>
    </div>

    <table class="tw-w-full tw-mt-4 tw-text-white">
      <thead>
        <tr class="tw-bg-gray-700">
          <th>No</th>
          <th>Vehicle</th>
          <th>Fuel Type</th>
          <th>Liters</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($fuelConsumptions as $fuel)
        <tr class="tw-border-b tw-border-gray-600">
          <td>{{ $loop->iteration }}</td>
          <td>{{ $fuel->vehicle->vehicle_name }}</td>
          <td>{{ $fuel->fuel_type }}</td>
          <td>{{ $fuel->fuel_liters }}</td>
          <td>{{ $fuel->fuel_date }}</td>
          <td>
            <a href="{{ route('fuel.pages.edit', $fuel) }}" class="tw-bg-orange-500 tw-px-3 tw-py-1 tw-rounded">Edit</a>
            <form action="{{ route('fuel.request.destroy', $fuel) }}" method="POST" class="tw-inline">
              @csrf @method('DELETE')
              <button type="submit" class="tw-bg-red-600 tw-px-3 tw-py-1 tw-rounded">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-app-layout>
