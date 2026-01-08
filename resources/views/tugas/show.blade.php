<x-app-layout>
    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-xl font-bold mb-4">{{ $tugas->judul }}</h1>
            <p class="mb-2">{{ $tugas->deskripsi }}</p>
            <p class="text-sm text-gray-600 mb-4">Deadline: {{ $tugas->deadline }}</p>

            @if($submission)
                <div class="p-4 bg-green-100 rounded">
                    <p class="text-green-700">Kamu sudah mengumpulkan tugas ini.</p>
                    @if($submission->file_path)
                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-600 underline">
                            Lihat File
                        </a>
                    @endif
                    @if($submission->nilai !== null)
                        <p class="mt-2">Nilai: <strong>{{ $submission->nilai }}</strong></p>
                        <p>Feedback: {{ $submission->feedback }}</p>
                    @endif
                </div>
            @else
                @if(\Carbon\Carbon::now()->lessThanOrEqualTo($tugas->deadline))
                    <form action="{{ route('tugas.submit', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Jawaban</label>
                            <textarea name="jawaban" class="w-full border rounded p-2"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Upload File</label>
                            <input type="file" name="file" class="block w-full">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Kumpulkan
                        </button>
                    </form>
                @else
                    <div class="p-4 bg-red-100 rounded">
                        <p class="text-red-700">Deadline sudah lewat. Kamu tidak bisa mengumpulkan tugas ini lagi.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
