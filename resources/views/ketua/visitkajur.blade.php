@extends('layout.main')

@section('content')
<div class="flex h-screen bg-[#f8f9fd] overflow-hidden" x-data="{ sideBarOpen: false }">
    
    @include('components.sidebarkajur')

    <div x-show="sideBarOpen" @click="sideBarOpen = false" x-transition.opacity 
         class="fixed inset-0 z-20 bg-black/50 md:hidden backdrop-blur-sm"></div>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <div class="md:hidden flex items-center justify-between p-4 bg-white shadow-sm z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-[#ff3366] to-[#a044ff] rounded-xl flex items-center justify-center shadow-lg shadow-purple-200 shrink-0">
                    <i class="fas fa-poll text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-lg font-extrabold text-gray-800 leading-tight">Data <span class="text-[#a044ff]">Kunjungan</span></h1>
                    <p class="text-[10px] text-gray-500 font-medium">Monitoring data tamu</p>
                </div>
            </div>
            <button @click="sideBarOpen = !sideBarOpen" class="p-2 text-gray-600 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <div class="flex-1 p-4 md:p-10 overflow-y-auto custom-scrollbar">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-8 gap-4">
                
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex w-14 h-14 bg-gradient-to-tr from-[#ff3366] to-[#a044ff] rounded-2xl items-center justify-center shadow-lg shadow-purple-200 shrink-0">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>

                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight hidden md:block">
                            Data <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff3366] to-[#a044ff]">Kunjungan</span>
                        </h2>
                        <p class="text-gray-500 text-xs md:text-sm mt-1 hidden md:block">Monitoring data tamu dan riwayat kunjungan.</p>
                    </div>
                </div>
                
                </div>

            <div class="bg-white p-4 rounded-2xl md:rounded-[2rem] shadow-sm border border-gray-100 mb-6 flex flex-col md:flex-row gap-3 md:gap-4">
                <form action="{{ url()->current() }}" method="GET" class="relative flex-1 w-full">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / NIM..." 
                           class="w-full pl-10 pr-4 py-3 bg-gray-50 rounded-xl outline-none focus:ring-2 focus:ring-[#a044ff] focus:bg-white transition font-medium text-gray-700 text-sm">
                </form>
                
                <div class="w-full md:w-auto">
                    <select onchange="window.location.href='?prodi='+this.value" class="w-full md:w-72 bg-gray-50 px-4 py-3 rounded-xl text-gray-600 font-bold outline-none cursor-pointer hover:bg-gray-100 transition text-sm text-ellipsis overflow-hidden">
                        <option value="">Semua Prodi</option>
                        
                        <option value="D3 Teknik Listrik" {{ request('prodi') == 'D3 Teknik Listrik' ? 'selected' : '' }}>
                            D3 Teknik Listrik
                        </option>
                        
                        <option value="D3 Teknik Elektronika" {{ request('prodi') == 'D3 Teknik Elektronika' ? 'selected' : '' }}>
                            D3 Teknik Elektronika
                        </option>
                        
                        <option value="D3 Teknik Informatika" {{ request('prodi') == 'D3 Teknik Informatika' ? 'selected' : '' }}>
                            D3 Teknik Informatika
                        </option>
                        
                        <option value="D4 Teknologi Rekayasa Pembangkit Energi" {{ request('prodi') == 'D4 Teknologi Rekayasa Pembangkit Energi' ? 'selected' : '' }}>
                            D4 Teknologi Rekayasa Pembangkit Energi
                        </option>
                        
                        <option value="D4 Sistem Informasi Kota Cerdas" {{ request('prodi') == 'D4 Sistem Informasi Kota Cerdas' ? 'selected' : '' }}>
                            D4 Sistem Informasi Kota Cerdas
                        </option>

                        <option value="Lainnya" {{ request('prodi') == 'Lainnya' ? 'selected' : '' }}>
                            Lainnya / Umum
                        </option>
                    </select>
                </div>
            </div>

            <div class="bg-white rounded-2xl md:rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto"> 
                    <table class="w-full text-left border-collapse whitespace-nowrap md:whitespace-normal">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#ff3366] via-[#a044ff] to-[#3366ff] text-white">
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">No. Kunjungan</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">NIM/NIP/NIK</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Prodi/Instansi</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider">Keperluan</th>
                                <th class="px-4 py-4 md:px-6 md:py-5 text-[10px] md:text-xs font-bold uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($visits as $v)
                            <tr class="hover:bg-purple-50/30 transition duration-200">
                                <td class="px-4 py-3 md:px-6 md:py-4 text-xs font-bold text-[#a044ff]">{{ $v->no_kunjungan ?? '-' }}</td>
                                <td class="px-4 py-3 md:px-6 md:py-4">
                                    <div class="text-xs md:text-sm font-bold text-gray-700">{{ $v->created_at->isoFormat('D MMM Y') }}</div>
                                    <div class="text-[10px] text-gray-400 font-medium">{{ $v->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4 text-xs md:text-sm font-bold text-gray-800 uppercase">{{ $v->nama }}</td>
                                <td class="px-4 py-3 md:px-6 md:py-4 text-xs md:text-sm text-gray-600 font-mono">{{ $v->nomor_induk }}</td>
                                <td class="px-4 py-3 md:px-6 md:py-4">
                                    <span class="px-2 py-1 md:px-3 md:py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 uppercase tracking-wide">
                                        {{ $v->prodi }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4 text-xs md:text-sm text-gray-500 italic truncate max-w-[100px] md:max-w-[150px]" title="{{ $v->keperluan }}">
                                    "{{ $v->keperluan }}"
                                </td>
                                <td class="px-4 py-3 md:px-6 md:py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick='showDetail(@json($v))' class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all shadow-sm" title="Lihat Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                        </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                    <i class="fas fa-folder-open text-4xl mb-3 block opacity-30"></i>
                                    <span class="text-sm font-medium">Belum ada data kunjungan.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
                    {{ $visits->links() }} 
                </div>
            </div>
        </div>
    </main>
</div>

<div id="modalDetail" class="fixed inset-0 z-[60] hidden bg-black/60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0 p-4">
    <div class="bg-white w-full md:max-w-md rounded-2xl overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300" id="modalDetailContent">
        
        <div class="bg-gradient-to-r from-[#ff3366] to-[#a044ff] p-5 flex justify-between items-center">
            <h3 class="text-white text-lg font-bold">Detail Kunjungan</h3>
            <button onclick="closeDetailModal()" class="text-white/80 hover:text-white transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <div>
                <p class="text-xs text-gray-500 mb-1">Nomor Kunjungan</p>
                <p class="text-sm font-bold text-gray-800" id="detailNo">-</p>
            </div>
            
            <div>
                <p class="text-xs text-gray-500 mb-1">Tanggal</p>
                <p class="text-sm font-bold text-gray-800" id="detailTanggal">-</p>
            </div>

            <div>
                <p class="text-xs text-gray-500 mb-1">Nama</p>
                <p class="text-sm font-bold text-gray-800" id="detailNama">-</p>
            </div>

            <div>
                <p class="text-xs text-gray-500 mb-1">NIM</p>
                <p class="text-sm font-bold text-gray-800" id="detailNim">-</p>
            </div>

            <div>
                <p class="text-xs text-gray-500 mb-1">Program Studi</p>
                <p class="text-sm font-bold text-[#a044ff]" id="detailProdi">-</p>
            </div>

            <div>
                <p class="text-xs text-gray-500 mb-1">Keperluan</p>
                <p class="text-sm font-bold text-gray-800" id="detailKeperluan">-</p>
            </div>
        </div>
    </div>
</div>

<script>
    // --- Javascript ---
    // Script Hapus & Edit DIHAPUS karena Kajur Read Only

    // --- Logika Modal DETAIL (TETAP ADA) ---
    const modalDetail = document.getElementById('modalDetail');
    const modalDetailContent = document.getElementById('modalDetailContent');

    function showDetail(data) {
        modalDetail.classList.remove('hidden');
        setTimeout(() => {
            modalDetail.classList.remove('opacity-0');
            modalDetailContent.classList.remove('scale-95');
            modalDetailContent.classList.add('scale-100');
        }, 10);

        // Isi Data ke Modal
        document.getElementById('detailNo').innerText = data.no_kunjungan || '-';
        document.getElementById('detailNama').innerText = data.nama;
        document.getElementById('detailNim').innerText = data.nomor_induk;
        document.getElementById('detailProdi').innerText = data.prodi;
        document.getElementById('detailKeperluan').innerText = data.keperluan;

        // Format Tanggal (Indonesia)
        if(data.created_at) {
            const dateObj = new Date(data.created_at);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('detailTanggal').innerText = dateObj.toLocaleDateString('id-ID', options);
        } else {
            document.getElementById('detailTanggal').innerText = '-';
        }
    }

    function closeDetailModal() {
        modalDetail.classList.add('opacity-0');
        modalDetailContent.classList.remove('scale-100');
        modalDetailContent.classList.add('scale-95');
        setTimeout(() => {
            modalDetail.classList.add('hidden');
        }, 300);
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
</style>
@endsection