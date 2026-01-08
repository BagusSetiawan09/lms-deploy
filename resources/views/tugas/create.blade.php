<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Tugas</h2>

        <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block font-medium">Judul</label>
                <input type="text" name="judul" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Deadline</label>
                <input type="date" name="deadline" class="w-full border rounded p-2">
            </div>

            <div class="mb-3">
                <label class="block font-medium">Upload File (PDF, Word, Excel)</label>
                <input type="file" name="file" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
