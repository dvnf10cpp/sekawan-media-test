<x-guest-layout>
  <div class="tw-h-screen tw-bg-gray-900 tw-flex tw-justify-center tw-items-center">
    <div class="tw-text-center">
      <h1 class="tw-font-bold tw-text-5xl lg:tw-text-7xl tw-text-secondary">404</h1>
      <p class="tw-mt-4 tw-text-2xl lg:tw-text-3xl tw-text-gray-300">Page Not Found</p>
      <a
        href="{{ route("auth.pages.login") }}"
        class="tw-inline-block tw-mt-6 tw-bg-secondary tw-text-white tw-py-2 tw-px-6 tw-rounded-md tw-border tw-border-secondary hover:tw-bg-white hover:tw-text-secondary tw-transition tw-duration-300"
      >
        Go Back Login
      </a>
    </div>
  </div>
</x-guest-layout>
