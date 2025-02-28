<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Tugas') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-500 text-white rounded-lg">
                <strong>Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tugas.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Judul Tugas</label>
                <input type="text" name="judul" required
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white"
                    value="{{ old('judul') }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" required
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">
                        <option value="menunggu">Menunggu</option>
                        <option value="dalam_proses">Dalam Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Prioritas</label>
                    <select name="prioritas" required
                        class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white">
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>
            </div>

            <div class="mb-4 mt-4">
                <label class="block text-gray-700 dark:text-gray-300">Tanggal Batas</label>
                <input type="date" name="tanggal_batas"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white"
                    value="{{ old('tanggal_batas') }}">
            </div>

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('tugas.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>