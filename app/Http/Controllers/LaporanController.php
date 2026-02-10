<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit; // Asumsi nama model Kunjungan
use App\Models\Survey; // Asumsi nama model Survey
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Input Filter
        $periode = $request->input('periode', 'bulan_ini'); // Default bulan ini
        $prodi = $request->input('prodi', '');

        // 2. Tentukan Range Tanggal
        $startDate = null;
        $endDate = Carbon::now();

        switch ($periode) {
            case 'hari_ini': $startDate = Carbon::today(); break;
            case '1_minggu': $startDate = Carbon::now()->subDays(7); break;
            case '1_bulan': $startDate = Carbon::now()->subMonth(); break;
            case '3_bulan': $startDate = Carbon::now()->subMonths(3); break;
            case '6_bulan': $startDate = Carbon::now()->subMonths(6); break;
            case 'tahun_ini': $startDate = Carbon::now()->startOfYear(); break;
            case 'bulan_ini': default: $startDate = Carbon::now()->startOfMonth(); break;
        }

        // 3. Query Dasar
        $visitQuery = Visit::query()->whereBetween('created_at', [$startDate, $endDate]);
        $surveyQuery = Survey::query()->whereBetween('created_at', [$startDate, $endDate]);

        // Terapkan Filter Prodi jika ada
        if ($prodi) {
            $visitQuery->where('prodi', $prodi);
            // Asumsi survey berelasi dengan visit untuk filter prodi
            $surveyQuery->whereHas('visit', function($q) use ($prodi) {
                $q->where('prodi', $prodi);
            });
        }

        // 4. Hitung Data untuk Cards
        $totalKunjungan = $visitQuery->count();
        $totalPengguna = User::count(); // Biasanya tidak terpengaruh filter tanggal
        $totalSurvey = $surveyQuery->count();
        
        // Kunjungan Hari Ini (Tetap ambil hari ini spesifik untuk card ke-4)
        $kunjunganHariIni = Visit::whereDate('created_at', Carbon::today());
        if($prodi) $kunjunganHariIni->where('prodi', $prodi);
        $kunjunganHariIni = $kunjunganHariIni->count();

        // 5. Data untuk Pie Chart & Tabel Rincian (Group by Prodi)
        // Kita perlu data mentah untuk chart dan tabel
        // Logic: Ambil semua prodi unik, hitung jumlah kunjungan dan avg rating per prodi
        $statsProdi = Visit::select('prodi', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('prodi')
            ->orderByDesc('total')
            ->get();

        // Siapkan data lengkap dengan persentase dan rating
        $laporanProdi = [];
        $grandTotal = $statsProdi->sum('total');

        foreach ($statsProdi as $stat) {
            // Hitung Rating rata-rata per prodi
            $avgRating = Survey::whereHas('visit', function($q) use ($stat) {
                $q->where('prodi', $stat->prodi);
            })->whereBetween('created_at', [$startDate, $endDate])
            ->avg(DB::raw('(kecepatan + keramahan + kejelasan + kenyamanan) / 4')); // Sesuaikan field rating Anda

            $laporanProdi[] = [
                'nama' => $stat->prodi,
                'total' => $stat->total,
                'persentase' => $grandTotal > 0 ? round(($stat->total / $grandTotal) * 100, 1) : 0,
                'rating' => $avgRating ? number_format($avgRating, 1) : '0.0',
                'survey_count' => Survey::whereHas('visit', function($q) use ($stat) {
                    $q->where('prodi', $stat->prodi);
                })->whereBetween('created_at', [$startDate, $endDate])->count()
            ];
        }

        return view('admin.laporan', compact(
            'totalKunjungan', 'totalPengguna', 'totalSurvey', 'kunjunganHariIni',
            'laporanProdi', 'periode', 'prodi'
        ));
    }

    public function indexKetua(Request $request)
    {
        // 1. Ambil Input Filter
        $periode = $request->input('periode', 'bulan_ini'); 
        $prodi = $request->input('prodi', '');

        // 2. Tentukan Range Tanggal
        $startDate = null;
        $endDate = Carbon::now();

        switch ($periode) {
            case 'hari_ini': $startDate = Carbon::today(); break;
            case '1_minggu': $startDate = Carbon::now()->subDays(7); break;
            case '1_bulan': $startDate = Carbon::now()->subMonth(); break;
            case '3_bulan': $startDate = Carbon::now()->subMonths(3); break;
            case '6_bulan': $startDate = Carbon::now()->subMonths(6); break;
            case 'tahun_ini': $startDate = Carbon::now()->startOfYear(); break;
            case 'bulan_ini': default: $startDate = Carbon::now()->startOfMonth(); break;
        }

        // 3. Query Dasar
        $visitQuery = Visit::query()->whereBetween('created_at', [$startDate, $endDate]);
        $surveyQuery = Survey::query()->whereBetween('created_at', [$startDate, $endDate]);

        // Filter Prodi
        if ($prodi) {
            $visitQuery->where('prodi', $prodi);
            $surveyQuery->whereHas('visit', function($q) use ($prodi) {
                $q->where('prodi', $prodi);
            });
        }

        // 4. Hitung Data
        $totalKunjungan = $visitQuery->count();
        $totalPengguna = User::count();
        $totalSurvey = $surveyQuery->count();
        
        $kunjunganHariIni = Visit::whereDate('created_at', Carbon::today());
        if($prodi) $kunjunganHariIni->where('prodi', $prodi);
        $kunjunganHariIni = $kunjunganHariIni->count();

        // 5. Data Chart & Tabel
        $statsProdi = Visit::select('prodi', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('prodi')
            ->orderByDesc('total')
            ->get();

        $laporanProdi = [];
        $grandTotal = $statsProdi->sum('total');

        foreach ($statsProdi as $stat) {
            $avgRating = Survey::whereHas('visit', function($q) use ($stat) {
                $q->where('prodi', $stat->prodi);
            })->whereBetween('created_at', [$startDate, $endDate])
            ->avg(DB::raw('(kecepatan + keramahan + kejelasan + kenyamanan) / 4')); 

            $laporanProdi[] = [
                'nama' => $stat->prodi,
                'total' => $stat->total,
                'persentase' => $grandTotal > 0 ? round(($stat->total / $grandTotal) * 100, 1) : 0,
                'rating' => $avgRating ? number_format($avgRating, 1) : '0.0',
                'survey_count' => Survey::whereHas('visit', function($q) use ($stat) {
                    $q->where('prodi', $stat->prodi);
                })->whereBetween('created_at', [$startDate, $endDate])->count()
            ];
        }

        // Perbedaan ada disini: return ke view kajur
        return view('kajur.laporankajur', compact(
            'totalKunjungan', 'totalPengguna', 'totalSurvey', 'kunjunganHariIni',
            'laporanProdi', 'periode', 'prodi'
        ));
    }
}