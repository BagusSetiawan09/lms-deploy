@push('font-class')
    font-roboto
@endpush

<x-app-layout>
    <div class="flex flex-col items-center min-h-screen my-12">
        <!-- Logo -->
        <div class="mb-4">
            <img src="{{ asset('image/codinglab.png') }}" alt="logo lengkap" class="w-[500px] h-auto">
        </div>

        <!-- Artikel -->
        <div class="w-[800px] h-auto space-y-4 text-center">
            <article>
                {{ __('CodingLab adalah perusahaan rintisan di bidang teknologi informasi yang berfokus pada layanan di bidang Web Design, Web Development, E-Government, Mobile Application, serta penyediaan solusi teknologi informasi yang inovatif dan terintegrasi.') }}
            </article>
            <article>
                {{ __('Startup ini didirikan dan dikelola oleh orang-orang yang memiliki passion di bidang Informasi dan Technology sejak 2017.') }}
            </article>
        </div>

        {{-- visi dan misi --}}
        <div class="grid grid-cols-2 my-14 bg-[#F3F4F6] rounded-lg">
            <div class="w-[500px] p-10 flex justify-center items-center">
                <img src="{{ asset('image/hero-3.jpg') }}" alt="hero-3" class="rounded-lg">
            </div>
            <div class="py-10 w-[500px] pr-10 text-justify space-y-2">
                <h1 class="capitalize font-bold text-xl">{{ __('visi kami') }}</h1>
                <article>{{ __('Menjadi perusahaan software house terkemuka yang memberdayakan bisnis dan masyarakat melalui solusi teknologi inovatif.') }}</article>
                <h1 class="capitalize font-bold text-xl pt-2">{{ __('misi kami') }}</h1>
                <ol class="list-decimal list-inside space-y-3">
                    <li>{{ __('Memberikan solusi perangkat lunak berkualitas tinggi dan inovatif untuk meningkatkan efisiensi operasional dan produktivitas bisnis pelanggan/mitra/client.') }}</li>
                    <li>{{ __('Mengutamakan inovasi dan pengembangan teknologi tepat guna untuk memberikan produk dan layanan yang unggul dan berdaya saing.') }}</li>
                    <li>{{ __('Membangun kemitraan strategis dan berkelanjutan dengan pelanggan, mitra, dan pemangku kepentingan lainnya untuk menciptakan ekosistem kolaboratif yang saling menguntungkan.') }}</li>
                    <li>{{ __('Mengutamakan kepuasan pelanggan dengan memberikan layanan yang responsif dan dukungan teknis yang berkualitas.') }}</li>
                    <li>{{ __('Berkontribusi pada komunitas dengan berbagi pengetahuan dan sumber daya dalam industri teknologi dan perangkat lunak.') }}</li>
                </ol>
            </div>
        </div>

        {{-- contact us --}}
        <div class="flex flex-col justify-center items-center">
            <h1 class="uppercase text-center text-3xl font-bold mb-5">contact us</h1>
            <div class="grid grid-cols-2 rounded-xl bg-[#33A1D9] w-[900px] h-[400px]">
                <div class="flex justify-center items-center" id="map">
                    <script>
                        function initMap() {
                            // kordinat
                            const lokasi = { lat: 3.535850106799819, lng: 98.69318053735276 };
                            const map = new google.maps.Map(document.getElementById("map"), {
                                zoom: 15,
                                center: lokasi,
                            });
                            new google.maps.Marker({
                                position: lokasi,
                                map: map,
                            });
                        }
                    </script>

                    <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAKrUZwJ4bk0RN4LjZi6hylc3lwJXA1Jk&callback=initMap">
                    </script>
                </div>
                <div class="flex flex-col justify-center items-start space-y-4 text-white">
                    <div class="flex px-3 items-center">
                        <img src="{{ asset('image/lokasi.png') }}" alt="icon-lokasi" class="w-auto h-[50px]">
                        <div class="mx-3">
                            <h2 class="font-bold">Address</h2>
                            <p class="font-light text-sm">Jl. STM Suka Elok No.5 Kec. Medan Johor Kota Medan</p>
                        </div>
                    </div>
                    <div class="flex px-3 items-center">
                        <img src="{{ asset('image/phone.png') }}" alt="icon-phone" class="w-auto h-[50px]">
                        <div class="mx-3">
                            <h2 class="font-bold">Phone</h2>
                            <p class="font-light text-sm">061-42785557</p>
                            <p class="font-light text-sm">0812-3435-5995</p>
                        </div>
                    </div>
                    <div class="flex px-3 items-center">
                        <img src="{{ asset('image/mail.png') }}" alt="icon-mail" class="w-auto h-[50px]">
                        <div class="mx-3">
                            <h2 class="font-bold">E-Mail</h2>
                            <p class="font-light text-sm">info@codinglab.id</p>
                            <p class="font-light text-sm">codinglab.id@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>