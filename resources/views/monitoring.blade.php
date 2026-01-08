<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Monitoring Progress Peserta Didik</h1>

                <div class="space-y-6">
                    @forelse($progressData->groupBy('user_name') as $namaPeserta => $progressList)
                        <div class="border rounded-lg shadow-sm">
                            <div class="bg-gray-100 px-4 py-2 font-semibold text-lg capitalize">
                                {{ $namaPeserta }}
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full border-t border-gray-300">
                                    <thead class="bg-gray-50 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Judul Video</th>
                                            <th class="px-4 py-2 text-left">Part</th>
                                            <th class="px-4 py-2 text-left">Progress</th>
                                            <th class="px-4 py-2 text-left">Update Terakhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($progressList as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2 capitalize">{{ $item->video_title }}</td>
                                                <td class="px-4 py-2 capitalize">{{ $item->part_title }}</td>
                                                <td class="px-4 py-2 w-64">
                                                    <div class="flex items-center gap-3">
                                                        @php
                                                            $percent = $item->is_complete ? 100 : (float)$item->progress;
                                                        @endphp
                                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                            <div class="bg-blue-500 h-2 rounded-full"
                                                                 style="width: {{ max(0, min(100, $percent)) }}%"></div>
                                                        </div>
                                                        <span class="text-sm text-gray-700 w-16 text-right">
                                                            {{ number_format($percent, 2) }}%
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-2">
                                                    {{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d M Y H:i') : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada data progress</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
