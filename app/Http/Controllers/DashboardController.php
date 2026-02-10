<?php

namespace App\Http\Controllers;
use App\Models\Visit;
use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function admin() {
        // Statistik untuk Card Utama
        $totalKunjungan = Visit::count();
        $totalPengguna = Visit::distinct('nomor_induk')->count();
        $totalSurvey = Survey::count();
        $kunjunganHariIni = Visit::whereDate('created_at', now())->count();
        
        // Data untuk Tabel Aktivitas Terbaru
        $aktivitasTerbaru = Visit::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKunjungan', 'totalPengguna', 'totalSurvey', 
            'kunjunganHariIni', 'aktivitasTerbaru'
        ));
        
    }

    // Method untuk halaman Data Kunjungan
    public function dataKunjungan() {
        $visits = Visit::latest()->get();
        return view('admin.visits', compact('visits'));
    }

    // Method untuk halaman Data Survey
    public function dataSurvey() {
        // Menggabungkan data survey dengan data visit untuk mendapatkan nama tamu
        $surveys = Survey::with('visit')->latest()->get();
        return view('admin.survey', compact('surveys'));
    }

    public function ketua()
    {
        // 1. Hitung total semua kunjungan
        $totalKunjungan = Visit::count();

        // 2. Hitung total pengguna (misal: filter role tertentu jika perlu)
        $totalPengguna = User::count();

        // 3. Hitung total survey (sesuaikan dengan nama model survey Anda)
        // $totalSurvey = Survey::count(); 
        $totalSurvey = 0; // Placeholder jika belum ada modelnya

        // 4. Hitung kunjungan khusus hari ini
        $kunjunganHariIni = Visit::whereDate('created_at', Carbon::today())->count();

        // 5. Ambil 5 aktivitas terbaru
        $aktivitasTerbaru = Visit::latest()->take(5)->get();

        // Kirim semua variabel ke view
        return view('ketua.dashboardkajur', compact(
            'totalKunjungan', 
            'totalPengguna', 
            'totalSurvey', 
            'kunjunganHariIni', 
            'aktivitasTerbaru'
        ));
    }
    
}