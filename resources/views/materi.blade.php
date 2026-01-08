<x-app-layout>
    <!-- Layout utama aplikasi -->

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <!-- Grid responsif untuk menampilkan daftar video dalam bentuk kartu -->

        @foreach ($videos as $video)
            <div class="flex flex-col gap-2 bg-blue-200 rounded-xl">
                <!-- Card video dengan background biru dan tampilan rounded -->

                <div class="p-5">
                    <!-- Bagian konten dalam card -->

                    @if($video->youtube_url)
                        @php
                            // Ambil video ID dari link YouTube dan buat thumbnail URL
                            preg_match('/(?:youtu\.be\/|v=)([^\&\?\/]+)/', $video->youtube_url, $matches);
                            $videoId = $matches[1] ?? null;
                            $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null;
                        @endphp

                        @if($thumbnailUrl)
                            <!-- Tampilkan thumbnail video YouTube -->
                            <img src="{{ $thumbnailUrl }}" alt="Thumbnail video" class="w-full h-90 object-cover rounded-md">
                        @else
                            <!-- Pesan jika link video tidak valid -->
                            <p class="text-red-500">Link video tidak valid</p>
                        @endif
                    @endif

                    <div class="mt-3">
                        <!-- Bagian informasi video -->

                        <span>
                            <!-- Tanggal dibuatnya video -->
                            {{ $video->created_at->format('d M Y') }}
                        </span>

                        <h2>
                            <!-- Judul video dengan link ke halaman detail materi -->
                            <a href="{{ route('materi.show', $video->slug) }}" class="text-blue-600 hover:underline text-lg font-semibold">
                                {{ $video->title }}
                            </a>
                        </h2>

                        <!-- Deskripsi singkat video -->
                        <p class="text-gray-600 text-sm">{{ $video->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
