@push('posisi')
    grid grid-cols-2
@endpush

@push('logo')
    py-3
@endpush

<x-guest-layout>
    <div class="hidden md:flex items-center justify-center">
        <img src="{{ asset('image/kucing.png') }}" alt="Login Image" class="w-3/4 object-contain">
    </div>
    <div class="flex items-center justify-center bg-[#F8FBFF] px-4">
        
        <div class="flex items-center justify-center bg-white rounded-xl shadow-md overflow-hidden">

            <!-- Kolom Kanan: Form Login -->
            <div class="md:p-12 flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang,</h2>
                <p class="text-gray-500 mb-6">Login sekarang untuk melanjutkan</p>

                 {{-- Flash Message dari Register --}}
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input id="email" name="email" type="email" required autofocus
                               class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Masukkan E-Mail anda" />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                               class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Password" />
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit"
                            class="w-full py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-md">
                        Masuk
                    </button>

                    <!-- Atau -->
                    <div class="text-center text-gray-400 text-sm">Atau</div>

                    <!-- Tombol Register -->
                    <a href="{{ route('register') }}"
                       class="w-full block text-center py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-md">
                        Buat Akun
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
