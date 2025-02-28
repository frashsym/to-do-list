<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hapus Tugas') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg text-center">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Apakah Anda yakin ingin menghapus tugas ini?
        </h3>

        <p class="mt-2 text-gray-700 dark:text-gray-300">
            <strong>Judul:</strong> {{ $tugas->judul }} <br>
            <strong>Deskripsi:</strong> {{ Str::limit($tugas->deskripsi, 100) }}
        </p>

        <div class="mt-6 flex justify-center space-x-4">
            <a href="{{ route('tugas.index') }}" 
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                Batal
            </a>

            <form action="{{ route('tugas.delete', $tugas->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
