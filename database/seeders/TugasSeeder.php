<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tugas;
use App\Models\User;

class TugasSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel tugas.
     */
    public function run()
    {
        // Pastikan ada user di database
        $users = User::pluck('id')->toArray();

        // Data dummy bertema materi sekolah
        $tugasList = [
            ['judul' => 'Ringkasan Sejarah Indonesia', 'deskripsi' => 'Buat ringkasan dari masa penjajahan hingga reformasi.', 'status' => 'menunggu', 'prioritas' => 'tinggi'],
            ['judul' => 'Latihan Soal Matematika', 'deskripsi' => 'Kerjakan 20 soal trigonometri.', 'status' => 'dalam_proses', 'prioritas' => 'sedang'],
            ['judul' => 'Praktikum Kimia', 'deskripsi' => 'Lakukan percobaan reaksi asam-basa dan buat laporan.', 'status' => 'menunggu', 'prioritas' => 'tinggi'],
            ['judul' => 'Makalah Biologi', 'deskripsi' => 'Tulis makalah tentang ekosistem hutan hujan tropis.', 'status' => 'menunggu', 'prioritas' => 'sedang'],
            ['judul' => 'Analisis Puisi', 'deskripsi' => 'Analisis puisi Chairil Anwar dan tulis kesimpulan.', 'status' => 'selesai', 'prioritas' => 'rendah'],
            ['judul' => 'Presentasi Fisika', 'deskripsi' => 'Siapkan presentasi tentang teori relativitas.', 'status' => 'dalam_proses', 'prioritas' => 'tinggi'],
            ['judul' => 'Tugas Seni Rupa', 'deskripsi' => 'Buat sketsa pemandangan dengan teknik arsir.', 'status' => 'menunggu', 'prioritas' => 'sedang'],
            ['judul' => 'Proyek Pemrograman', 'deskripsi' => 'Buat aplikasi kalkulator sederhana dengan Python.', 'status' => 'menunggu', 'prioritas' => 'tinggi'],
            ['judul' => 'Esai Sosiologi', 'deskripsi' => 'Tulis esai tentang dampak media sosial pada remaja.', 'status' => 'selesai', 'prioritas' => 'rendah'],
            ['judul' => 'Prakarya Elektronika', 'deskripsi' => 'Buat rangkaian lampu LED dengan saklar.', 'status' => 'dalam_proses', 'prioritas' => 'sedang'],
        ];

        foreach ($tugasList as $tugas) {
            Tugas::create([
                'user_id' => rand(1, 2),
                'judul' => $tugas['judul'],
                'deskripsi' => $tugas['deskripsi'],
                'status' => $tugas['status'],
                'prioritas' => $tugas['prioritas'],
                'tanggal_batas' => now()->addDays(rand(1, 14)),
            ]);
        }
    }
}
