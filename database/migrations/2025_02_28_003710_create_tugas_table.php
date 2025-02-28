<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->string('judul'); // Judul tugas
            $table->text('deskripsi')->nullable(); // Deskripsi tugas (opsional)
            $table->enum('status', ['menunggu', 'dalam_proses', 'selesai'])->default('menunggu'); // Status tugas
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang'); // Prioritas tugas
            $table->dateTime('tanggal_batas')->nullable(); // Deadline tugas
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tugas');
        Schema::enableForeignKeyConstraints();
    }
};
