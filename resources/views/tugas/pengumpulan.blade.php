<x-app-layout>
    <div class="py-6 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Pengumpulan Tugas: {{ $tugas->judul }}</h1>

        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Nama Peserta</th>
                    <th class="px-4 py-2">Jawaban</th>
                    <th class="px-4 py-2">File</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Nilai</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($submissions as $sub)
                    <tr>
                        <td class="px-4 py-2">{{ $sub->user->name }}</td>
                        <td class="px-4 py-2">{{ $sub->jawaban ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if($sub->file_path)
                                <a href="{{ asset('storage/'.$sub->file_path) }}" class="text-indigo-600 underline" target="_blank">Lihat File</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2 capitalize">{{ $sub->status ?? '-' }}</td>
                        <td class="px-4 py-2">
                            {{ $sub->nilai ?? '-' }}
                        </td>
                        <td class="px-4 py-2">
                            <form method="POST" action="{{ route('tugas.nilai', [$tugas->id, $sub->user_id]) }}" class="flex gap-2">
                                @csrf
                                <input type="number" name="nilai" min="0" max="100" value="{{ $sub->nilai }}"
                                    class="w-20 border rounded px-2 py-1">
                                <input type="text" name="feedback" value="{{ $sub->feedback }}"
                                    class="border rounded px-2 py-1">
                                <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4">Belum ada submission</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
