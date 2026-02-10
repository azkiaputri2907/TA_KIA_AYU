@extends('layout.main')

@section('content')
<div class="flex h-screen bg-[#f8f9fd] overflow-hidden" x-data="{ sideBarOpen: false }">
    
    @include('components.sidebar')

    <div x-show="sideBarOpen" @click="sideBarOpen = false" x-transition.opacity 
         class="fixed inset-0 z-20 bg-black/50 md:hidden backdrop-blur-sm"></div>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <div class="md:hidden flex items-center justify-between p-4 bg-white shadow-sm z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-[#ff3366] to-[#a044ff] rounded-xl flex items-center justify-center shadow-lg shadow-purple-200 shrink-0">
                    <i class="fas fa-poll text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-lg font-extrabold text-gray-800 leading-tight">Laporan <span class="text-[#a044ff]">Statistik</span></h1>
                    <p class="text-[10px] text-gray-500 font-medium">Analisis data dan unduh laporan</p>
                </div>
            </div>
            <button @click="sideBarOpen = !sideBarOpen" class="p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <div class="flex-1 p-4 md:p-10 overflow-y-auto custom-scrollbar">
            <div class="flex flex-col md:flex-row justify-between 
            items-start md:items-center mb-6 md:mb-8 gap-4">
<div class="flex items-center gap-4">

    <div class="hidden md:flex w-14 h-14 
                bg-gradient-to-tr from-[#ff3366] to-[#a044ff] 
                rounded-2xl items-center justify-center 
                shadow-lg shadow-purple-200 
                shrink-0 transform hover:scale-105 
                transition-transform duration-300">
        <i class="fas fa-chart-pie text-white text-2xl"></i>
    </div>

    <div>
        <h2 class="text-2xl md:text-3xl font-extrabold 
                   text-gray-800 tracking-tight hidden md:block">
            Laporan & 
            <span class="text-transparent bg-clip-text 
                         bg-gradient-to-r from-[#ff3366] to-[#a044ff]">
                Statistik
            </span>
        </h2>
        <p class="text-gray-500 text-xs md:text-sm mt-1 hidden md:block">
            Analisis data dan unduh laporan
        </p>
    </div>

</div>


                <div class="flex gap-2 w-full md:w-auto">
                    <button class="flex-1 md:flex-none justify-center bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2.5 rounded-xl text-sm font-bold transition flex items-center gap-2 shadow-sm border border-red-100">
                        <i class="fas fa-file-pdf"></i> <span class="hidden md:inline">Export PDF</span><span class="md:hidden">PDF</span>
                    </button>
                    <button class="flex-1 md:flex-none justify-center bg-green-50 text-green-600 hover:bg-green-600 hover:text-white px-4 py-2.5 rounded-xl text-sm font-bold transition flex items-center gap-2 shadow-sm border border-green-100">
                        <i class="fas fa-file-excel"></i> <span class="hidden md:inline">Export Excel</span><span class="md:hidden">Excel</span>
                    </button>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-xl md:rounded-[2rem] shadow-sm border border-gray-100 mb-8">
                <form action="{{ route('admin.laporan') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    
                    <div>
                        <label class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block pl-1">Filter Periode</label>
                        <div class="relative">
                            <select name="periode" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2.5 md:py-3 bg-gray-50 rounded-lg md:rounded-xl outline-none focus:ring-2 focus:ring-[#ff3366] text-xs md:text-sm font-bold text-gray-700 appearance-none border-none cursor-pointer hover:bg-gray-100 transition">
                                <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="1_minggu" {{ $periode == '1_minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                                <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="1_bulan" {{ $periode == '1_bulan' ? 'selected' : '' }}>30 Hari Terakhir</option>
                                <option value="3_bulan" {{ $periode == '3_bulan' ? 'selected' : '' }}>3 Bulan Terakhir</option>
                                <option value="6_bulan" {{ $periode == '6_bulan' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                <option value="tahun_ini" {{ $periode == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                            </select>
                            <i class="fas fa-calendar-alt absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block pl-1">Filter Program Studi</label>
                        <div class="relative">
                            <select name="prodi" onchange="this.form.submit()" 
                                    class="w-full pl-4 pr-10 py-2.5 md:py-3 bg-gray-50 rounded-lg md:rounded-xl outline-none focus:ring-2 focus:ring-[#a044ff] text-xs md:text-sm font-bold text-gray-700 cursor-pointer border-none appearance-none hover:bg-gray-100 transition">
                                <option value="">Semua Prodi</option>
                                <option value="D3 Teknik Listrik" {{ request('prodi') == 'D3 Teknik Listrik' ? 'selected' : '' }}>D3 Teknik Listrik</option>
                                <option value="D3 Teknik Elektronika" {{ request('prodi') == 'D3 Teknik Elektronika' ? 'selected' : '' }}>D3 Teknik Elektronika</option>
                                <option value="D3 Teknik Informatika" {{ request('prodi') == 'D3 Teknik Informatika' ? 'selected' : '' }}>D3 Teknik Informatika</option>
                                <option value="D4 Teknologi Rekayasa Pembangkit Energi" {{ request('prodi') == 'D4 Teknologi Rekayasa Pembangkit Energi' ? 'selected' : '' }}>D4 TRPE</option>
                                <option value="D4 Sistem Informasi Kota Cerdas" {{ request('prodi') == 'D4 Sistem Informasi Kota Cerdas' ? 'selected' : '' }}>D4 SIKC</option>
                                <option value="Lainnya" {{ request('prodi') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <i class="fas fa-filter absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div class="bg-gradient-to-r from-[#ff3366] to-[#ff5e84] p-6 rounded-[2rem] text-white shadow-lg shadow-pink-200 relative overflow-hidden group transition-transform hover:scale-[1.02]">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm"><i class="fas fa-file-alt"></i></div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold relative z-10">{{ number_format($totalKunjungan) }}</h3>
                    <p class="text-xs md:text-sm opacity-90 font-medium mt-1 relative z-10">Total Kunjungan</p>
                </div>

                <div class="bg-gradient-to-r from-[#3366ff] to-[#5e84ff] p-6 rounded-[2rem] text-white shadow-lg shadow-blue-200 relative overflow-hidden transition-transform hover:scale-[1.02]">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm"><i class="fas fa-users"></i></div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold relative z-10">{{ number_format($totalPengguna) }}</h3>
                    <p class="text-xs md:text-sm opacity-90 font-medium mt-1 relative z-10">Pengguna Terdaftar</p>
                </div>

                <div class="bg-gradient-to-r from-[#ff3366] via-[#a044ff] to-[#3366ff] p-6 rounded-[2rem] text-white shadow-lg shadow-purple-200 relative overflow-hidden transition-transform hover:scale-[1.02]">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm"><i class="fas fa-check-circle"></i></div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold relative z-10">{{ number_format($totalSurvey) }}</h3>
                    <p class="text-xs md:text-sm opacity-90 font-medium mt-1 relative z-10">Survey Terisi</p>
                </div>

                <div class="bg-gradient-to-r from-[#33ccff] to-[#3366ff] p-6 rounded-[2rem] text-white shadow-lg shadow-cyan-200 relative overflow-hidden transition-transform hover:scale-[1.02]">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm"><i class="fas fa-chart-line"></i></div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold relative z-10">{{ number_format($kunjunganHariIni) }}</h3>
                    <p class="text-xs md:text-sm opacity-90 font-medium mt-1 relative z-10">Kunjungan Hari Ini</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center justify-center relative min-h-[350px]">
                    <h3 class="font-extrabold text-gray-800 text-lg w-full mb-4">Distribusi Per Prodi</h3>
                    
                    @if(count($laporanProdi) > 0)
                        <div class="w-full h-64 relative">
                            <canvas id="prodiChart"></canvas>
                        </div>
                        <p class="text-center text-xs text-gray-400 mt-4">Persentase kunjungan berdasarkan filter yang dipilih</p>
                    @else
                         <div class="flex flex-col items-center justify-center h-48 text-gray-400">
                            <i class="fas fa-chart-pie text-4xl mb-2 opacity-50"></i>
                            <span class="text-sm">Tidak ada data untuk ditampilkan</span>
                         </div>
                    @endif
                </div>

                <div class="lg:col-span-2 bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-extrabold text-gray-800 text-lg">Rincian Statistik</h3>
                        <span class="text-[10px] font-bold bg-blue-50 text-blue-600 px-3 py-1 rounded-full uppercase tracking-wide">{{ str_replace('_', ' ', $periode) }}</span>
                    </div>

                    <div class="overflow-x-auto custom-scrollbar pb-2">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="text-gray-400 border-b border-gray-100">
                                    <th class="py-3 px-2 text-xs font-bold uppercase tracking-wider">Program Studi</th>
                                    <th class="py-3 px-2 text-xs font-bold uppercase tracking-wider text-center">Persentase</th>
                                    <th class="py-3 px-2 text-xs font-bold uppercase tracking-wider text-center">Jumlah</th>
                                    <th class="py-3 px-2 text-xs font-bold uppercase tracking-wider text-center">Survey</th>
                                    <th class="py-3 px-2 text-xs font-bold uppercase tracking-wider text-right">Rating Avg</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($laporanProdi as $row)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-2">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-8 rounded-full bg-gray-200 indicator-color shrink-0"></div>
                                            <span class="font-bold text-gray-700 text-xs md:text-sm max-w-[150px] md:max-w-none truncate" title="{{ $row['nama'] }}">
                                                {{ $row['nama'] }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-2 text-center">
                                        <span class="bg-blue-50 text-blue-600 text-xs font-bold px-2 py-1 rounded-lg">
                                            {{ $row['persentase'] }}%
                                        </span>
                                    </td>
                                    <td class="py-4 px-2 text-center">
                                        <span class="font-bold text-gray-800">{{ number_format($row['total']) }}</span>
                                    </td>
                                    <td class="py-4 px-2 text-center">
                                        <span class="text-gray-500 text-sm">{{ number_format($row['survey_count']) }}</span>
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <span class="font-bold text-[#a044ff]">{{ $row['rating'] }}</span>
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-400 text-sm">Belum ada data pada periode ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dataProdi = @json($laporanProdi);
        
        if (dataProdi.length > 0) {
            const ctx = document.getElementById('prodiChart').getContext('2d');
            const labels = dataProdi.map(item => item.nama);
            const dataValues = dataProdi.map(item => item.total);
            const backgroundColors = ['#3366ff', '#a044ff', '#ff3366', '#33ccff', '#ffcc00', '#00cc99', '#ff9966'];

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataValues,
                        backgroundColor: backgroundColors,
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#1f2937',
                            bodyColor: '#4b5563',
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    let total = context.chart._metasets[context.datasetIndex].total;
                                    let percentage = Math.round((value / total) * 100) + '%';
                                    return ' ' + value + ' (' + percentage + ')';
                                }
                            }
                        }
                    }
                }
            });

            // Warnai indikator di tabel agar sama dengan chart
            document.querySelectorAll('.indicator-color').forEach((el, index) => {
                el.style.backgroundColor = backgroundColors[index % backgroundColors.length];
            });
        }
    });
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
</style>
@endsection