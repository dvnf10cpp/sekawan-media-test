<x-app-layout>
  <div class="tw-mx-5 tw-p-4 tw-bg-gray-900 tw-min-h-screen tw-text-white tw-rounded-lg">
    <div class="tw-mb-8 tw-text-center">
      <h1 class="tw-text-3xl tw-font-bold">Vehicle Usage Records</h1>

    </div>

    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-6">
      <div class="tw-p-6 tw-bg-gray-800 tw-rounded-lg tw-shadow-lg">
        <h2 class="tw-text-xl tw-font-semibold tw-mb-4">Pemakaian Kendaraan Selama 6 Bulan Terakhir</h2>
        <div class="tw-w-full lg:tw-h-[400px] tw-overflow-x-auto">
          <canvas id="vehicleUsageMonth"></canvas>
        </div>
      </div>

      <div class="tw-p-6 tw-bg-gray-800 tw-rounded-lg tw-shadow-lg">
        <h2 class="tw-text-xl tw-font-semibold tw-mb-4">Top 10 Kendaraan yang Sering Digunakan</h2>
        <div class="tw-w-full lg:tw-h-[400px] tw-overflow-x-auto">
          <canvas id="topKVehicleUsage"></canvas>
        </div>
      </div>

      <div class="tw-p-6 tw-bg-gray-800 tw-rounded-lg tw-shadow-lg tw-col-span-1 lg:tw-col-span-2">
        <h2 class="tw-text-xl tw-font-semibold tw-mb-4">Penggunaan Berdasarkan Tipe Kendaraan</h2>
        <div class="tw-w-full lg:tw-h-[800px] tw-overflow-x-auto">
          <canvas id="typeVehicleUsage"></canvas>
        </div>
      </div>
    </div>

    <script>
      const usageMonthCtx = document.getElementById('vehicleUsageMonth').getContext('2d');
      const topKCtx = document.getElementById('topKVehicleUsage').getContext('2d');
      const usageTypeCtx = document.getElementById('typeVehicleUsage').getContext('2d');

      // Chart Configuration for Grafana Look
      const grafanaColors = {
        backgroundColor: 'rgba(47, 54, 64, 0.8)',
        borderColor: 'rgba(255, 206, 86, 1)'
      };



      // Line Chart - Vehicle Usage by Month
      new Chart(usageMonthCtx, {
        type: 'line',
        data: {
          labels: @json($data['usageDataMonth']['labels']),
          datasets: [{
            label: 'Jumlah Kendaraan',
            data: @json($data['usageDataMonth']['data']),
            backgroundColor: 'rgba(0, 188, 212, 0.2)',
            borderColor: '#00BCD4',
            borderWidth: 2,
            pointBackgroundColor: '#00BCD4',
            pointRadius: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRation: false,
          plugins: {
            legend: {
              display: true,
              labels: { color: 'white' }
            }
          },
          scales: {
            x: { ticks: { color: 'white' } },
            y: { ticks: { color: 'white' }, beginAtZero: true }
          }
        }
      });

      // Bar Chart - Top 10 Vehicles
      new Chart(topKCtx, {
        type: 'bar',
        data: {
          labels: @json($data['top10Usage']['labels']),
          datasets: [{
            label: 'Jumlah Penggunaan',
            data: @json($data['top10Usage']['data']),
            backgroundColor: '#1E88E5',
            borderColor: '#1565C0',
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRation: false,
          plugins: {
            legend: { display: false }
          },
          scales: {
            x: { ticks: { color: 'white' } },
            y: { ticks: { color: 'white' }, beginAtZero: true }
          }
        }
      });

      // Bar Chart - Vehicle Usage by Type
      new Chart(usageTypeCtx, {
        type: 'bar',
        data: {
          labels: @json($data['usageType']['labels']),
          datasets: [{
            label: 'Jumlah Penggunaan',
            data: @json($data['usageType']['data']),
            backgroundColor: '#FF7043',
            borderColor: '#E64A19',
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRation: false,
          plugins: {
            legend: { display: false }
          },
          scales: {
            x: { ticks: { color: 'white' } },
            y: { ticks: { color: 'white' }, beginAtZero: true }
          }
        }
      });
    </script>
  </div>
</x-app-layout>
