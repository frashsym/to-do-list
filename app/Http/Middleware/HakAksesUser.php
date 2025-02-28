<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Tugas;

class HakAksesUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil ID tugas dari route jika ada
        $tugasId = $request->route('id'); 
        if (!$tugasId) {
            return $next($request); // Jika tidak ada ID, lanjutkan tanpa pemeriksaan
        }

        // Cari tugas berdasarkan ID
        $tugas = Tugas::find($tugasId);

        // Jika tugas tidak ditemukan atau user bukan pemiliknya, redirect
        if (!$tugas || $tugas->user_id !== Auth::id()) {
            return redirect()->route('tugas.index')->with('error', 'Anda tidak memiliki akses tersebut.');
        }

        return $next($request);
    }
}
