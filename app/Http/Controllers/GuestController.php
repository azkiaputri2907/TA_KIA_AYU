<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;   // Model Kunjungan
use App\Models\Survey;  // Model Survey
use Carbon\Carbon;

class GuestController extends Controller
{
    // =========================================================
    // 1. DASHBOARD & HALAMAN DEPAN (PUBLIK)
    // =========================================================
    public function index() {

    // 1. Total kunjungan
    $totalKunjungan = Visit::count();

    // 2. Kunjungan hari ini
    $kunjunganHariIni = Visit::whereDate('created_at', Carbon::today())->count();

    // 3. Rating rata-rata
    $totalRating = Survey::avg('kecepatan') ?? 0;

    // 4. Statistik bulan ini
    $kunjunganBulanIni = Visit::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->count();

    $jumlahMahasiswa = Visit::whereRaw("nomor_induk REGEXP '^[0-9]+$'")->count();
    $jumlahLainnya = $totalKunjungan - $jumlahMahasiswa;

    $persenMahasiswa = $totalKunjungan > 0 
        ? round(($jumlahMahasiswa / $totalKunjungan) * 100) 
        : 0;

    $persenLainnya = $totalKunjungan > 0 
        ? round(($jumlahLainnya / $totalKunjungan) * 100) 
        : 0;

    // 5. HITUNG EFISIENSI ADMIN (survey dibanding kunjungan)
    $totalSurvey = Survey::count();

    $efisiensiAdmin = $totalKunjungan > 0
        ? round(($totalSurvey / $totalKunjungan) * 100, 1)
        : 0;

    $periode = 'sepanjang_waktu';

    return view('landing', compact(
        'totalKunjungan',
        'kunjunganHariIni',
        'kunjunganBulanIni',
        'persenMahasiswa',
        'persenLainnya',
        'totalRating',
        'efisiensiAdmin',
        'periode'
    ));
}

    // =========================================================
    // 2. FORM INPUT & LOGIKA PENCARIAN (PUBLIK)
    // =========================================================
    public function create() {
        // --- LOGIKA NOMOR URUT OTOMATIS ---
        $today = Carbon::now()->format('Y-m-d');
        
        // Cari kunjungan terakhir hari ini untuk generate nomor urut
        $lastVisit = Visit::whereDate('created_at', $today)
                          ->orderBy('id', 'desc')
                          ->first();

        if (!$lastVisit) {
            $nomorUrut = 1;
        } else {
            // Ambil 3 angka belakang dari nomor kunjungan terakhir (misal: C0-20241022-005 -> 5)
            $lastNumber = (int) substr($lastVisit->no_kunjungan, -3);
            $nomorUrut = $lastNumber + 1;
        }

        // Format: C0-YYYYMMDD-001
        $kodeOtomatis = 'C0-' . Carbon::now()->format('Ymd') . '-' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        return view('guest.form', compact('kodeOtomatis'));
    }

    // --- LOGIKA AJAX CHECK VISITOR (AUTO-FILL) ---
    public function checkVisitor($nomor_induk)
    {
        // Cari data kunjungan terakhir berdasarkan nomor induk
        $tamu = Visit::where('nomor_induk', $nomor_induk)
                     ->orderBy('created_at', 'desc') // Ambil yang paling baru
                     ->first();

        if ($tamu) {
            return response()->json([
                'status' => 'found',
                'data' => $tamu
            ]);
        } else {
            return response()->json([
                'status' => 'not_found'
            ]);
        }
    }

    // =========================================================
    // 3. PROSES SIMPAN DATA (PUBLIK & ADMIN)
    // =========================================================
    public function store(Request $request) {
        // Validasi Input
        $request->validate([
            'nama' => 'required',
            'keperluan' => 'required',
            'nomor_induk' => 'required',
        ]);

        // Generate No Kunjungan jika kosong (misal input dari Admin manual)
        $no_kunjungan = $request->no_kunjungan;
        if(empty($no_kunjungan)){
             $today = Carbon::now()->format('Y-m-d');
             $lastVisit = Visit::whereDate('created_at', $today)->orderBy('id', 'desc')->first();
             $nomorUrut = $lastVisit ? ((int) substr($lastVisit->no_kunjungan, -3) + 1) : 1;
             $no_kunjungan = 'C0-' . Carbon::now()->format('Ymd') . '-' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);
        }

        // Simpan Data
        $visit = Visit::create([
            'no_kunjungan' => $no_kunjungan,
            'nama'         => $request->nama,
            'nomor_induk'  => strtoupper($request->nomor_induk), // Paksa huruf besar
            'instansi'     => $request->instansi ?? '-', 
            'prodi'        => $request->prodi ?? '-',
            'keperluan'    => $request->keperluan,
            'status'       => 'Selesai', // Default status
        ]);
        
        // Cek asal request: Jika dari Admin Panel, redirect back. Jika dari Guest, ke halaman sukses.
        if ($request->routeIs('visits.store')) {
             return redirect()->back()->with('success', 'Data kunjungan berhasil ditambahkan!');
        }

        // Default: Arahkan tamu ke halaman sukses survey
        return redirect()->route('guest.success', ['id' => $visit->id]);
    }

    // =========================================================
    // 4. FLOW SURVEY & VERIFIKASI (PUBLIK)
    // =========================================================
    public function success($id) {
        $visit = Visit::findOrFail($id);
        return view('guest.success', compact('visit'));
    }

    public function showSurvey($id) {
        $visit = Visit::findOrFail($id);
        return view('guest.survey', compact('visit'));
    }

    public function storeSurvey(Request $request) {
        $request->validate([
            'visit_id' => 'required',
            'kecepatan' => 'required',
        ]);

        Survey::create($request->all());

        return redirect()->route('landing')->with('success', 'Terima kasih atas penilaian Anda!');
    }

    // =========================================================
    // 5. ADMIN PANEL FEATURES (CRUD VISITS)
    // =========================================================
    
    // ADMIN: Dashboard (Jika diperlukan terpisah dari DashboardController)
    public function adminDashboard() {
        $totalKunjungan = Visit::count();
        $totalPengguna = Visit::distinct('nomor_induk')->count();
        $totalSurvey = Survey::count();
        $kunjunganHariIni = Visit::whereDate('created_at', now())->count();
        
        $aktivitasTerbaru = Visit::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalKunjungan', 'totalPengguna', 'totalSurvey', 'kunjunganHariIni', 'aktivitasTerbaru'
        ));
    }

    // ADMIN: Halaman Index Kunjungan (Tabel)
    public function indexVisits(Request $request) {
        $query = Visit::query();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_induk', 'like', "%{$search}%")
                  ->orWhere('no_kunjungan', 'like', "%{$search}%");
            });
        }

        // Fitur Filter Prodi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }

        $visits = $query->latest()->paginate(10);

        return view('admin.visit', compact('visits'));
    }

    // ADMIN: Update Data
    public function updateVisit(Request $request, $id) {
        $visit = Visit::findOrFail($id);
        
        $visit->update([
            'nama' => $request->nama,
            'nomor_induk' => $request->nomor_induk,
            'prodi' => $request->prodi,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // ADMIN: Hapus Data
    public function destroyVisit($id) {
        $visit = Visit::findOrFail($id);
        $visit->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
    public function indexSurvey(Request $request) {
        // Mulai query dengan eager loading 'visit'
        $query = Survey::with('visit');

        // --- 1. LOGIKA SEARCH (Nama / NIM) ---
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('visit', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_induk', 'like', "%{$search}%");
            });
        }

        // --- 2. LOGIKA FILTER PRODI ---
        if ($request->filled('prodi')) {
            $prodi = $request->prodi;
            $query->whereHas('visit', function($q) use ($prodi) {
                $q->where('prodi', $prodi);
            });
        }

        // Ambil data + pagination + pertahankan query string (supaya filter gak hilang pas ganti halaman)
        $surveys = $query->latest()->paginate(10)->withQueryString();

        return view('admin.survey', compact('surveys'));
    }

    public function indexVisitsKetua(Request $request) {
        $query = Visit::query();

        // 1. Logika Pencarian (Sama dengan Admin)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_induk', 'like', "%{$search}%")
                  ->orWhere('no_kunjungan', 'like', "%{$search}%");
            });
        }

        // 2. Logika Filter Prodi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }

        // 3. Ambil data (Paginate)
        // withQueryString() penting agar filter tidak hilang saat pindah halaman 2, 3, dst.
        $visits = $query->latest()->paginate(10)->withQueryString();

        // 4. Return ke View Khusus Ketua
        // Pastikan Anda menyimpan file blade yang saya buatkan sebelumnya 
        // di folder: resources/views/ketua/visitkajur.blade.php
        return view('ketua.visitkajur', compact('visits'));

        
    }

    public function indexSurveyKetua(Request $request) {
    $query = Survey::with('visit');

    // Filter Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('visit', function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('nomor_induk', 'like', "%{$search}%");
        });
    }

    // Filter Prodi
    if ($request->filled('prodi')) {
        $prodi = $request->prodi;
        $query->whereHas('visit', function($q) use ($prodi) {
            $q->where('prodi', $prodi);
        });
    }

    $surveys = $query->latest()->paginate(10)->withQueryString();

    return view('ketua.surveykajur', compact('surveys'));
}
}