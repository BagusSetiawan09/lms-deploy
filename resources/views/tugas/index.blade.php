@push('font-class')
    font-roboto
@endpush
<x-app-layout>
    <div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6">
        <div x-data="{ confirmDelete: false }">
        <!-- Header Daftar Tugas -->
        <div>
             <div class="flex items-center justify-between">
                @role('admin|pembimbing')
                    <h2 class="text-2xl font-bold mb-4">📌 Daftar Tugas</h2>
                    <button @click="confirmDelete = true" class="text-black hover:text-red-600">
                        <i class='bx bxs-trash-x text-2xl'></i>
                    </button>
                @endrole
                @role('user')
                    <h2 class="text-2xl font-bold mb-4">📌 Tugas</h2>
                @endrole
            </div>
        </div>
        @role('pembimbing')
            <div class="mb-3">
                <a href="{{ route('tugas.create') }}" class="btn btn-primary">
                    + Tambah Tugas
                </a>
            </div>
        @endrole

        
        @role('pembimbing')
            <!-- Modal Konfirmasi -->
            <div x-show="confirmDelete" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" >
                <div class="bg-white p-6 rounded-lg shadow-xl w-96 text-center">
                    <h3 class="text-lg font-semibold mb-4">Apakah kamu yakin ingin menghapus riwayat tugas ini?</h3>
                    <div class="flex justify-center gap-4">
                        <!-- Tombol Ya -->
                        <form method="POST" action="{{ route('tugas.destroy', $tugas->first()->id ?? 0) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                Ya
                            </button>
                        </form>
                        <!-- Tombol Tidak -->
                        <button 
                            @click="confirmDelete = false" 
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400"
                        >
                            Tidak
                        </button>
                    </div>
                </div>
            </div>
        @endrole
    </div>

    {{-- table tugas --}}
    <table class="w-full border border-gray-200 mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Judul</th>
                <th class="border px-4 py-2 text-left">Deadline</th>
                <th class="border px-4 py-2 text-center">Tanggal Pengerjaan</th>
                <th class="border px-4 py-2 text-center">File</th>
                @role('user')
                    <th class="border px-4 py-2 text-center">Kumpulkan</th>
                @endrole
            </tr>
        </thead>
        <tbody>
            @foreach($tugas as $t)
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2 capitalize">{{ $t->judul }}</td>
                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($t->deadline)->format('d M Y H:i') }}</td>
                <td class="border px-3 py-2">
                    {{ \Carbon\Carbon::parse($t->updated_at)->format('d M Y H:i') }}
                </td>
                <td class="border px-4 py-2 text-center">
                   <a href="{{ asset('storage/' . $t->file) }}" target="_blank" class="text-blue-600 hover:underline"><i class='bxr  bxs-file'  style='color:#000000'></i></a>
                </td>
                @role('user')
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('tugas.show', $t->id) }}"class="inline-block bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700">
                            Kumpulkan Tugas
                        </a>
                    </td>
                @endrole
            </tr>
            @role('pembimbing|admin')
                <tr>
                    <td colspan="4" class="bg-gray-50 p-4">
                        <h3 class="font-semibold mb-2">Pengumpulan:</h3>
                        <table class="w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-3 py-2 text-left">Nama Murid</th>
                                    <th class="border px-3 py-2 text-left">Dikumpulkan Pada</th>
                                    <th class="border px-3 py-2 text-center">File</th>
                                    <th class="border px-3 py-2 text-center">Nilai</th>
                                    <th class="border px-3 py-2 text-center">Keterangan</th>
                                    <th class="border px-3 py-2 text-center">Simpan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($t->submissions as $p)
                                    <tr>
                                        <td class="border px-3 py-2">{{ $p->user->name }}</td>
                                        <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($p->updated_at)->format('d M Y H:i') }}</td>
                                        <td class="border px-3 py-2 text-center">
                                            <a href="{{ asset('storage/'.$p->file) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                        </td>

                                        <!-- FORM UPDATE -->
                                        <form method="POST" action="{{ route('submissions.update', $p->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <td class="border px-3 py-2 text-center">
                                                <input type="number" name="nilai" value="{{ $p->nilai }}" class="border rounded w-16 px-2 py-1">
                                            </td>
                                            <td class="border px-3 py-2 text-center">
                                                <input type="text" name="feedback" value="{{ $p->feedback }}" class="border rounded px-2 py-1 w-32">
                                            </td>
                                            <td class="border px-3 py-2 text-center">
                                                <button type="submit" class="ml-3" title="{{ $p->nilai || $p->feedback ? 'Update' : 'Simpan' }}">
                                                    @if($p->nilai || $p->feedback)
                                                        <i class='bx bx-checks text-green-600 text-xl'></i>
                                                    @else
                                                        <i class='bx bxs-bookmark-plus text-gray-600 text-xl'></i>
                                                    @endif
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @empty
                                    @if (\Carbon\Carbon::now()->lessThanOrEqualTo($t->deadline))
                                        <tr>
                                            <td colspan="6" class="border px-3 py-2 text-center text-gray-500">Belum ada pengumpulan</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" class="border px-3 py-2 text-center text-red-500">Sudah deadline</td>
                                        </tr>
                                    @endif
                                @endforelse
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endrole
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
