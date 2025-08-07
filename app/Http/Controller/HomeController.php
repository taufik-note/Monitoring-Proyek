<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use App\Models\Tugas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan data dinamis.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Hitung total proyek
        $totalProyek = Proyek::count();
        
        // Hitung tugas aktif (status != selesai)
        $tugasAktif = Tugas::where('status', '!=', 'selesai')->count();
        
        // Hitung tugas selesai
        $tugasSelesai = Tugas::where('status', 'selesai')->count();

        // Ambil 5 proyek terbaru
        $recentProyeks = Proyek::orderBy('created_at', 'desc')->take(5)->get();

        // Ambil 5 tugas terbaru
        $recentTugas = Tugas::orderBy('created_at', 'desc')->take(5)->get();
        
        return view('home', compact(
            'totalProyek',
            'tugasAktif',
            'tugasSelesai',
            'recentProyeks',
            'recentTugas'
        ));
    }

    /**
     * Menangani permintaan untuk halaman lain (jika ada).
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('about'); // Pastikan view about.blade.php ada di resources/views
    }

    // Tambahkan metode lain sesuai kebutuhan

}
