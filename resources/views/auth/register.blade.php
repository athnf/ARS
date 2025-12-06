<x-guest-layout>
    
    <div class="p-8 bg-white rounded-lg shadow-2xl border border-gray-200">
        
        <div class="text-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-extrabold text-gray-900 uppercase tracking-wider">
                BUAT AKUN BARU
            </h1>
            <p class="text-sm text-gray-500 mt-1">Daftar sekarang untuk mulai memesan tiket.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-semibold" />
                <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-gray-900 focus:ring-gray-900 shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-gray-900 focus:ring-gray-900 shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Nomor Telepon')" class="text-gray-700 font-semibold" />
                <x-text-input id="phone" class="block mt-1 w-full border-gray-300 focus:border-gray-900 focus:ring-gray-900 shadow-sm" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-gray-900 focus:ring-gray-900 shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-gray-900 focus:ring-gray-900 shadow-sm"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between pt-4">
                <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Sudah terdaftar?
                </a>

                <x-primary-button class="bg-gray-900 hover:bg-black font-extrabold uppercase tracking-widest px-6 py-3">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>