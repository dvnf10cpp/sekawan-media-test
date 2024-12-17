<nav class="navbar navbar-expand-lg tw-bg-gray-800 tw-text-white tw-px-2 lg:tw-px-10 tw-py-3">
  <div class="container-fluid">
    <!-- Navbar Brand -->
    <a class="navbar-brand tw-font-bold {{ Route::is('*dashboard*') ? 'tw-text-green-500' : 'tw-text-white' }}" href="/dashboard">
      PT Tambang Media
    </a>

    <!-- Navbar Toggler -->
    <button class="navbar-toggler tw-text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="tw-bg-white tw-block tw-w-6 tw-h-0.5 tw-mb-1 tw-mt-2"></span>
      <span class="tw-bg-white tw-block tw-w-6 tw-h-0.5 tw-mb-1"></span>
      <span class="tw-bg-white tw-block tw-w-6 tw-h-0.5 tw-mb-2"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
        <!-- Dropdown Menu -->
        <div class="dropdown">
          <button
            class="btn dropdown-toggle tw-bg-gray-800 hover:tw-bg-gray-700 {{ Route::is('vehicles*') ? 'tw-text-green-500 tw-font-semibold' : 'tw-text-white' }}"
            type="button"
            id="vehicleDropdown"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Manajemen Kendaraan
          </button>
          <ul class="dropdown-menu tw-bg-gray-800 tw-shadow-lg tw-rounded-lg" aria-labelledby="vehicleDropdown">
            <li>
              <a class="dropdown-item tw-text-gray-300 hover:tw-bg-gray-700 hover:tw-text-white"
                 href="{{ route('vehicles.pages.index') }}">
                List Kendaraan
              </a>
            </li>
            <li>
              <a class="dropdown-item tw-text-gray-300 hover:tw-bg-gray-700 hover:tw-text-white"
                 href="{{ route('services.pages.index') }}">
                Perbaikan Kendaraan
              </a>
            </li>
            <li>
              <a class="dropdown-item tw-text-gray-300 hover:tw-bg-gray-700 hover:tw-text-white"
                 href="{{ route('vehicles.pages.index') }}">
                Konsumsi BBM Kendaraan
              </a>
            </li>
          </ul>
        </div>

        <!-- Other Nav Items -->
        <x-navlink route="reservations*" href="{{ route('reservations.pages.index') }}" name="Pemesanan"/>
        <x-navlink route="drivers*" href="{{ route('drivers.pages.index') }}" name="Pengemudi"/>
        <x-navlink route="logs*" href="{{ route('logs.pages.index') }}" name="Log Aplikasi"/>
        <x-navlink route="users*" href="{{ route('users.pages.index') }}" name="Pengguna"/>

        <!-- Hidden for Small Screens -->
        <div class="tw-block lg:tw-hidden">
          <li class="nav-item">
            <a class="nav-link tw-text-white" href="#">{{ auth()->user()->fullname }}</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('auth.request.logout') }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="tw-bg-red-600 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-red-700 tw-text-sm" type="submit">
                Logout
              </button>
            </form>
          </li>
        </div>
      </ul>

      <!-- Right Aligned for Large Screens -->
      <div class="lg:tw-flex tw-justify-end navbar-nav tw-hidden tw-gap-x-5">
        <li class="nav-item">
          <a class="nav-link tw-text-white" href="#">{{ auth()->user()->fullname }}</a>
        </li>
        <li class="nav-item tw-flex tw-justify-center tw-items-center">
          <form action="{{ route('auth.request.logout') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="tw-bg-red-600 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-red-700 tw-text-sm" type="submit">
              Logout
            </button>
          </form>
        </li>
      </div>
    </div>
  </div>
</nav>
<div class="tw-h-[1px] tw-bg-black tw-w-full"></div>
