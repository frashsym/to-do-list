<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\User;

class TugasController extends Controller
{
    /**
     * Menampilkan daftar tugas (API & Web).
     */
    public function index()
    {
        $tugas = Tugas::with('user')->paginate(5);
        $users = User::all();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $tugas,
            ]);
        }

        return view('tugas.tugas', compact('tugas', 'users'));
    }

    /**
     * Menampilkan detail tugas (API & Web).
     */
    public function show(Request $request, $id)
    {
        $tugas = Tugas::with('user')->findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $tugas,
            ]);
        }

        return view('tugas.show', compact('tugas'));
    }

    /**
     * Menampilkan halaman tambah tugas.
     */
    public function create()
    {
        $users = User::all();
        return view('tugas.create', compact('users'));
    }

    /**
     * Menyimpan tugas baru (API & Web).
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:menunggu,dalam_proses,selesai',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggal_batas' => 'nullable|date',
        ]);

        $tugas = Tugas::create($request->all());

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil ditambahkan.',
                'data' => $tugas,
            ], 201);
        }

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit tugas.
     */
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $users = User::all();
        return view('tugas.edit', compact('tugas', 'users'));
    }

    /**
     * Mengupdate tugas (API & Web).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:menunggu,dalam_proses,selesai',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggal_batas' => 'nullable|date',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->update($request->all());

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil diperbarui.',
                'data' => $tugas,
            ]);
        }

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Menampilkan halaman konfirmasi hapus tugas.
     */
    public function confirm($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('tugas.delete', compact('tugas'));
    }

    /**
     * Menghapus tugas (API & Web).
     */
    public function delete($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil dihapus.',
            ]);
        }

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus!');
    }
}
