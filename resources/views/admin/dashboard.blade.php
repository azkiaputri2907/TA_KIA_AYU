@extends('layout.main')
@section('content')
<div class="flex h-screen bg-[#f8f9fd] overflow-hidden" x-data="{ sideBarOpen: false }">
    
    @include('components.sidebar')

    <div x-show="sideBarOpen" 
         @click="sideBarOpen = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm lg:hidden"></div>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden transition-all duration-300"
         :class="sideBarOpen ? 'blur-sm scale-[0.99] lg:blur-none lg:scale-100' : ''">
        
        <header class="bg-white border-b lg:hidden px-6 py-4 flex justify-between items-center shadow-sm z-30">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-white/20 rounded-lg backdrop-blur-md flex items-center justify-center border border-white/20">
                    <img src="{{ asset('img/logo_poliban.png') }}" alt="Logo Poliban" class="w-full h-full object-contain">
                </div>
                <div class="leading-tight">
                    <span class="text-black font-bold text-lg md:text-xl block tracking-wide">Jurusan Teknik Elektro</span>
                </div>
            </div>
            <button @click.stop="sideBarOpen = true" class="p-2 bg-gray-50 text-[#a044ff] rounded-xl hover:bg-gray-100 active:scale-95 transition">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </header>

        <main class="flex-1 p-4 md:p-10 overflow-y-auto custom-scrollbar">
            
            <div class="mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-tr from-[#ff3366] to-[#a044ff] rounded-2xl flex items-center justify-center shadow-lg shadow-purple-200 shrink-0 transform -rotate-3 hover:rotate-0 transition-transform cursor-default">
                        <i class="fas fa-user-tie text-white text-xl md:text-2xl"></i>
                    </div>
                    
                    <div>
                        <h2 class="text-2xl md:text-4xl font-extrabold text-gray-800 tracking-tight leading-tight uppercase">
                            Dashboard <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#a044ff] to-[#3366ff]">Admin</span>
                        </h2>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="w-6 md:w-8 h-1 bg-gradient-to-r from-[#ff3366] to-[#a044ff] rounded-full"></span>
                            <p class="text-gray-500 font-medium tracking-wide text-xs md:text-sm uppercase">Selamat datang di sistem manajemen buku tamu digital</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 bg-white px-4 py-3 rounded-2xl shadow-sm border border-gray-100 self-start sm:self-center cursor-pointer hover:bg-gray-50 transition-all relative" id="calendar-trigger">
                    <div class="text-left sm:text-right">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Hari Ini</p>
                        <p class="text-xs md:text-sm font-bold text-gray-700">{{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
                    </div>
                    <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center text-[#a044ff]">
                        <i class="far fa-calendar-alt text-base"></i>
                    </div>
                    <input type="text" id="datepicker" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
                <div class="bg-gradient-to-r from-[#ff3366] to-[#ff5e84] p-6 rounded-[2rem] text-white shadow-lg relative overflow-hidden group transition-transform hover:scale-[1.02]">
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-white/20 p-2 rounded-lg"><i class="fas fa-file-alt"></i></div>
                        </div>
                        <h3 class="text-3xl md:text-4xl font-bold">{{ number_format($totalKunjungan) }}</h3>
                        <p class="text-xs md:text-sm opacity-80 font-medium mt-1">Total Kunjungan</p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#3366ff] to-[#5e84ff] p-6 rounded-[2rem] text-white shadow-lg transition-transform hover:scale-[1.02]">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-white/20 p-2 rounded-lg"><i class="fas fa-users"></i></div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-bold">{{ number_format($totalPengguna) }}</h3>
                    <p class="text-xs md:text-sm opacity-80 font-medium mt-1">Pengguna Terdaftar</p>
                </div>

                <div class="bg-gradient-to-r from-[#ff3366] via-[#a044ff] to-[#3366ff] p-6 rounded-[2rem] text-white shadow-lg transition-transform hover:scale-[1.02]">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-white/20 p-2 rounded-lg"><i class="fas fa-check-circle"></i></div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-bold">{{ number_format($totalSurvey) }}</h3>
                    <p class="text-xs md:text-sm opacity-80 font-medium mt-1">Survey Terisi</p>
                </div>

                <div class="bg-gradient-to-r from-[#33ccff] to-[#3366ff] p-6 rounded-[2rem] text-white shadow-lg transition-transform hover:scale-[1.02]">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-white/20 p-2 rounded-lg"><i class="fas fa-chart-line"></i></div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-bold">{{ number_format($kunjunganHariIni) }}</h3>
                    <p class="text-xs md:text-sm opacity-80 font-medium mt-1">Kunjungan Hari Ini</p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-gray-800 text-lg">Aktivitas Terbaru</h3>
                </div>
                <div class="space-y-4">
                    @forelse($aktivitasTerbaru as $act)
                    <div class="flex justify-between items-center border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-xs md:text-sm uppercase tracking-tight">{{ $act->nama }}</p>
                                <p class="text-[10px] md:text-xs text-gray-500 font-medium">{{ $act->prodi }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold text-gray-400 block uppercase tracking-tighter">{{ $act->created_at->diffForHumans() }}</span>                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10">
                        <i class="fas fa-inbox text-3xl text-gray-200 mb-3 block"></i>
                        <p class="text-gray-400 text-sm">Belum ada aktivitas hari ini</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    /* Agar scrollbar cantik di Chrome/Safari */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<style>
/* ===== Base Calendar Style ===== */
.flatpickr-calendar {
    width: 100% !important;
    max-width: 340px;
    border-radius: 1.5rem !important;
    border: none !important;
    padding: 1rem !important;
    background: #ffffff !important;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08) !important;
    margin-top: 12px !important;
    font-family: 'Poppins', sans-serif;
    animation: fadeIn 0.2s ease-in-out;
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== Header ===== */
.flatpickr-months {
    margin-bottom: 10px;
}

.flatpickr-months .flatpickr-month {
    color: #222 !important;
    font-weight: 700;
    font-size: 0.95rem;
}

.flatpickr-current-month .flatpickr-monthDropdown-months {
    font-weight: 800 !important;
}

/* ===== Day Style ===== */
.flatpickr-day {
    border-radius: 10px !important;
    transition: all 0.2s ease;
}

.flatpickr-day:hover {
    background: #f3f4f6 !important;
    transform: scale(1.05);
}

/* Selected Day */
.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange {
    background: linear-gradient(135deg, #ff3366, #a044ff) !important;
    color: #fff !important;
    border: none !important;
}

/* Today */
.flatpickr-day.today {
    border: 2px solid #a044ff !important;
}

/* ===== Responsive ===== */
@media (max-width: 480px) {
    .flatpickr-calendar {
        max-width: 95vw;
        padding: 0.8rem !important;
        border-radius: 1.2rem !important;
    }

    .flatpickr-day {
        font-size: 0.8rem;
    }

    .flatpickr-months .flatpickr-month {
        font-size: 0.85rem;
    }
}
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datepicker", {
            locale: "id",
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            defaultDate: "today",
            // Menutup kalender otomatis setelah pilih tanggal
            onChange: function(selectedDates, dateStr, instance) {
                console.log("Tanggal dipilih: " + dateStr);
                // Di sini Anda bisa menambahkan logika redirect jika ingin filter data berdasarkan tanggal
                // window.location.href = "/admin?date=" + dateStr;
            }
        });

        // Trigger klik pada div agar kalender terbuka saat area mana saja di badge tanggal diklik
        document.getElementById('calendar-trigger').addEventListener('click', function() {
            document.getElementById('datepicker')._flatpickr.open();
        });
    });
</script>

@endsection