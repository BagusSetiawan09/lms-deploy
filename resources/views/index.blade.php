@push('bg-class')
    bg-gradient-to-b from-white to-[#56A2C8] overflow-hidden
@endpush
@push('font-class')
    font-roboto
@endpush
<x-app-layout>
   <div class="grid grid-cols-2 gap-1 px-14 pt-16">
        <div>
            {{-- Judul --}}
            <div class="text-[#0080FF] font-bold text-[50px] pb-2 uppercase">
                {{ __('memulai pelajaran lebih baik') }}
                {{ __('mulai dari sini') }}
            </div>
            {{-- article --}}
            <div class="border-l-2 border-black h-[80px] text-black capitalize flex items-center">
               <p class="px-2">{{ __('Kami percaya bahwa peningkatan keterampilan dan pengembangan diri secara berkelanjutan merupakan kunci untuk membangun masa depan yang lebih baik, baik bagi individu maupun organisasi.') }}</p>
            </div>
            {{-- button untuk login --}}
            <a href="{{ route('login') }}">
                 <div class="flex rounded-xl font-bold text-white bg-[#33A1D9] w-[380px] justify-center h-[80px] items-center my-32 capitalize text-[30px]">
                    <p>{{ __('mulai sekarang') }}</p>
                    <img src="{{ asset('image/panah-kanan.png') }}" alt="teruskan">
                </div>
            </a>
        </div>
        <div class="relative w-full flex justify-center items-start">
            <div class="z-10">
                <img src="{{ asset('image/diskusi-1.jpg') }}" alt="hero 1" class="w-auto h-72 rounded-xl shadow-lg">
            </div>
            <div class="absolute right-72 top-32 z-20">
                <img src="{{ asset('image/diskusi-2.jpg') }}" alt="hero 2" class="w-auto h-72 rounded-xl shadow-2xl">
            </div>
        </div>
    </div>
</x-app-layout>