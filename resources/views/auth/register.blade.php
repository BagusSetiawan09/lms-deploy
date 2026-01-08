@push('posisi')
    flex justify-center items-center
@endpush

@push('logo')
    flex justify-center items-center py-7
@endpush

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

       <div x-data="{ role: '' }">
    <!-- Pilih Role -->
    <div>
        <x-input-label for="role" :value="__('Role')" />
        <select id="role" name="role" x-model="role"
            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            <option value="">-- Pilih Role --</option>
            <option value="user">User</option>
            <option value="pembimbing">Pembimbing</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    <!-- Nama Pembimbing (hanya muncul jika role = user) -->
    <div x-show="role === 'user'" class="mt-4">
        <x-input-label for="nama_pembimbing" :value="__('Nama Pembimbing')" />
        <select id="nama_pembimbing" name="nama_pembimbing"
            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">-- Pilih Pembimbing --</option>
            @foreach($pembimbings as $pembimbing)
                <option value="{{ $pembimbing->name }}">{{ $pembimbing->name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('nama_pembimbing')" class="mt-2" />
    </div>
</div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
