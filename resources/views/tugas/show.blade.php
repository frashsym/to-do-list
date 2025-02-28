<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Tugas') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ $tugas->judul }}</h3>

        <div class="mb-4">
            <p class="text-gray-700 dark:text-gray-300"><strong>Deskripsi:</strong></p>
            <p class="text-gray-900 dark:text-gray-100">{{ $tugas->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-700 dark:text-gray-300"><strong>Status:</strong></p>
                <p class="text-gray-900 dark:text-gray-100 capitalize">{{ $tugas->status }}</p>
            </div>
            <div>
                <p class="text-gray-700 dark:text-gray-300"><strong>Prioritas:</strong></p>
                <p class="text-gray-900 dark:text-gray-100 capitalize">{{ $tugas->prioritas }}</p>
            </div>
            <div>
                <p class="text-gray-700 dark:text-gray-300"><strong>Tanggal Batas:</strong></p>
                <p class="text-gray-900 dark:text-gray-100">
                    {{ $tugas->tanggal_batas ? \Carbon\Carbon::parse($tugas->tanggal_batas)->format('d M Y') : '-' }}
                </p>
            </div>
            <div>
                <p class="text-gray-700 dark:text-gray-300"><strong>Dibuat Oleh:</strong></p>
                <p class="text-gray-900 dark:text-gray-100">{{ $tugas->user->name ?? 'Tidak diketahui' }}</p>
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('tugas.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Kembali</a>

            @if(auth()->id() === $tugas->user_id)
                <a href="{{ route('tugas.edit', $tugas->id) }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>
                <a href="{{ route('tugas.confirm', $tugas->id) }}"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</a>
            @endif
        </div>
    </div>
</x-app-layout>
