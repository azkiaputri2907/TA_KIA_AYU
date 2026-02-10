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
                    <h1 class="text-lg font-extrabold text-gray-800 leading-tight">Data <span class="text-[#a044ff]">Survey</span></h1>
                    <p class="text-[10px] text-gray-500 font-medium">Kelola data survey kepuasan tamu</p>
                </div>
            </div>
            <button @click="sideBarOpen = !sideBarOpen" class="p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <div class="flex-1 p-4 md:p-10 overflow-y-auto custom-scrollbar">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-8 gap-4">
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex w-14 h-14 bg-gradient-to-tr from-[#ff3366] to-[#a044ff] rounded-2xl items-center justify-center shadow-lg shadow-purple-200 shrink-0 transform hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-poll text-white text-2xl"></i>
                    </div>

                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight hidden md:block">
                            Data <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff3366] to-[#a044ff]">Survey</span>
                        </h2>
                        <p class="text-gray-500 text-xs md:text-sm mt-1 hidden md:block">Kelola data survey kepuasan tamu</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl md:rounded-[2rem] shadow-sm border border-gray-100 mb-6 flex flex-col md:flex-row gap-3 md:gap-4">
                <form action="{{ route('admin.survey') }}" method="GET" class="relative flex-1 w-full">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / NIM..." 
                           class="w-full pl-10 pr-4 py-3 bg-gray-50 rounded-xl outline-none focus:ring-2 focus:ring-[#a044ff] focus:bg-white transition font-medium text-gray-700 text-sm">
                </form>
                
                <div class="w-full md:w-auto">
                    <select onchange="window.location.href=this.value" class="w-full md:w-72 bg-gray-50 px-4 py-3 rounded-xl text-gray-600 font-bold outline-none cursor-pointer hover:bg-gray-100 transition text-sm text-ellipsis overflow-hidden border-none appearance-none">
                        <option value="{{ route('admin.survey') }}">Semua Prodi</option>
                        @foreach(['D3 Teknik Listrik', 'D3 Teknik Elektronika', 'D3 Teknik Informatika', 'D4 Teknologi Rekayasa Pembangkit Energi', 'D4 Sistem Informasi Kota Cerdas', 'Lainnya'] as $prodi)
                            <option value="{{ route('admin.survey', ['prodi' => $prodi]) }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>
                                {{ $prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="bg-white rounded-2xl md:rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto"> 
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#ff3366] via-[#a044ff] to-[#3366ff] text-white">
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">No</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Pengunjung</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Rata-rata</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Feedback</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($surveys as $index => $s)
                            @php $avg = ($s->kecepatan + $s->keramahan + $s->kejelasan + $s->kenyamanan) / 4; @endphp
                            <tr class="hover:bg-purple-50/30 transition duration-200">
                                <td class="px-4 py-3 md:px-6 md:py-4 text-xs font-bold text-[#a044ff]">
                                    {{ $surveys->firstItem() + $index }}
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4">
                                    <div class="text-xs md:text-sm font-bold text-gray-700">{{ $s->created_at->isoFormat('D MMM Y') }}</div>
                                    <div class="text-[10px] text-gray-400 font-medium">{{ $s->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4">
                                    <div class="text-xs md:text-sm font-bold text-gray-800 uppercase">{{ $s->visit->nama ?? 'Data Terhapus' }}</div>
                                    <div class="text-[10px] text-gray-500 font-mono">{{ $s->visit->nomor_induk ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4">
                                    <div class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-yellow-50 text-yellow-600 border border-yellow-100">
                                        <span class="text-xs md:text-sm font-black">{{ number_format($avg, 1) }}</span>
                                        <i class="fas fa-star text-[10px]"></i>
                                    </div>
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4 text-xs md:text-sm text-gray-500 italic truncate max-w-[150px]" title="{{ $s->feedback }}">
                                    "{{ Str::limit($s->feedback, 30) ?: '-' }}"
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick='showDetailSurvey(@json($s), @json($s->visit), {{ $avg }})' class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all shadow-sm" title="Lihat Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>

                                        <form action="{{ route('survey.destroy', $s->id) }}" method="POST" class="delete-form inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete w-8 h-8 rounded-lg flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus Data">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                    <i class="fas fa-poll text-4xl mb-3 block opacity-30"></i>
                                    <span class="text-sm font-medium">Belum ada data survey.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
                    {{ $surveys->links() }} 
                </div>
            </div>
        </div>
    </main>
</div>

<div id="modalDetail" class="fixed inset-0 z-[60] hidden bg-black/60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0 p-4">
    <div class="bg-white w-full md:max-w-md rounded-2xl overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300" id="modalDetailContent">
        
        <div class="bg-gradient-to-r from-[#ff3366] to-[#a044ff] p-5 flex justify-between items-center">
            <h3 class="text-white text-lg font-bold">Detail Laporan Survey</h3>
            <button onclick="closeDetailModal()" class="text-white/80 hover:text-white transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                <div>
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Nama Pengunjung</p>
                    <p class="text-sm font-extrabold text-gray-800" id="detailNama">-</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-500 uppercase font-bold">Rata-rata Skor</p>
                    <div class="flex items-center gap-1 justify-end text-[#a044ff] font-black">
                        <span id="detailAvg">0</span> <i class="fas fa-star text-[10px] text-yellow-400"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-3 rounded-xl">
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Kecepatan</p>
                    <p class="text-sm font-bold text-gray-700" id="detailKecepatan">0/5</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-xl">
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Keramahan</p>
                    <p class="text-sm font-bold text-gray-700" id="detailKeramahan">0/5</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-xl">
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Kejelasan</p>
                    <p class="text-sm font-bold text-gray-700" id="detailKejelasan">0/5</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-xl">
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Kenyamanan</p>
                    <p class="text-sm font-bold text-gray-700" id="detailKenyamanan">0/5</p>
                </div>
            </div>

            <div class="bg-purple-50/50 p-4 rounded-xl border border-purple-100">
                <p class="text-[10px] text-[#a044ff] font-bold uppercase mb-1">Komentar / Feedback</p>
                <p class="text-sm text-gray-700 italic leading-relaxed" id="detailFeedback">"-"</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert Success
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            customClass: { popup: 'rounded-[2rem] p-6' }
        });
    @endif

    // Hapus Data
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            let form = this.closest('.delete-form');
            Swal.fire({
                title: 'Hapus Survey?',
                text: "Laporan survey ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff3366',
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[2rem] p-6' }
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Modal Detail Logic
    const modalDetail = document.getElementById('modalDetail');
    const modalDetailContent = document.getElementById('modalDetailContent');

    function showDetailSurvey(s, visit, avg) {
        modalDetail.classList.remove('hidden');
        setTimeout(() => {
            modalDetail.classList.remove('opacity-0');
            modalDetailContent.classList.remove('scale-95');
            modalDetailContent.classList.add('scale-100');
        }, 10);

        document.getElementById('detailNama').innerText = visit ? visit.nama : 'Data Terhapus';
        document.getElementById('detailAvg').innerText = avg.toFixed(1);
        document.getElementById('detailKecepatan').innerText = s.kecepatan + '/5';
        document.getElementById('detailKeramahan').innerText = s.keramahan + '/5';
        document.getElementById('detailKejelasan').innerText = s.kejelasan + '/5';
        document.getElementById('detailKenyamanan').innerText = s.kenyamanan + '/5';
        document.getElementById('detailFeedback').innerText = s.feedback ? `"${s.feedback}"` : '"Tidak ada feedback"';
    }

    function closeDetailModal() {
        modalDetail.classList.add('opacity-0');
        modalDetailContent.classList.add('scale-95');
        setTimeout(() => modalDetail.classList.add('hidden'), 300);
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
</style>
@endsection