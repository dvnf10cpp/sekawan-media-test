<x-guest-layout>
    {{-- <h1>Made By Devan</h1> --}}
    <div class="tw-bg-gray-900 tw-h-screen">
        <div class="tw-flex tw-justify-center tw-items-center tw-h-full">
            <!-- Card Container -->
            <div
                class="tw-border tw-border-gray-700 tw-bg-gray-800 tw-rounded-lg tw-pt-10 tw-pb-20 tw-px-16 tw-w-[500px] tw-shadow-lg">
                <!-- Header -->
                <div>
                    <div class="tw-flex tw-justify-center tw-items-center">

                        <h1 class="tw-text-white tw-text-4xl tw-font-semibold tw-text-center">PT Tambang Media</h1>
                    </div>
                    <h1 class="tw-text-3xl tw-font-semibold tw-text-gray-200 tw-text-center tw-mt-4">
                        Login
                    </h1>
                </div>

                <div class="tw-h-[1px] tw-bg-gray-700 tw-my-5"></div>

                <!-- Login Form -->
                <form action="{{ route('auth.request.login') }}" method="POST">
                    @csrf
                    <x-input type="email" name="Email" id="email" value="{{ old('email') }}"
                        placeholder="Masukkan email akun kamu" />
                    <x-input type="password" name="Password" id="password" value="{{ old('password') }}"
                        placeholder="Masukkan password akun kamu" />
                    <!-- Remember Me Checkbox -->
                    <div class="tw-mb-4 tw-flex tw-items-center tw-text-gray-300">
                        <input type="checkbox" class="tw-rounded tw-border-gray-500 focus:tw-ring-secondary"
                            name="remember" id="remember">
                        <label for="remember" class="tw-ml-2">Remember Me</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="tw-mb-4">
                        <button type="submit"
                            class="tw-w-full tw-bg-secondary tw-text-white tw-py-2 tw-rounded-md hover:tw-bg-white hover:tw-text-secondary tw-border tw-border-secondary tw-duration-300 tw-ease-in-out">
                            Login
                        </button>
                    </div>

                    <!-- Alert Component -->
                    <x-alert />


                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
