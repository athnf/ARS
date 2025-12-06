<x-guest-layout>
    
    <div class="p-8 bg-white rounded-lg shadow-2xl border border-gray-200">
        
        <div class="text-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-extrabold text-gray-900 uppercase tracking-wider">
                LOGIN KE AKUN ARS
            </h1>
            <p class="text-sm text-gray-500 mt-1">Akses panel admin atau dashboard pengguna.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-gray-900 focus:ring-gray-900 shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />

                <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-gray-900 focus:ring-gray-900 shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-between items-center">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-900 shadow-sm focus:ring-gray-900" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-between pt-4">
                <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    Belum punya akun?
                </a>
                
                <x-primary-button class="bg-gray-900 hover:bg-black font-extrabold uppercase tracking-widest px-6 py-3">
                    {{ __('Log In') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>