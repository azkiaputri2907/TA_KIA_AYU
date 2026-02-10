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
                    <h1 class="text-lg font-extrabold text-gray-800 leading-tight">Data <span class="text-[#a044ff]">Kunjungan</span></h1>
                    <p class="text-[10px] text-gray-500 font-medium">Kelola data kunjungan tamu</p>
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
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>

                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight hidden md:block">
                            Data <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff3366] to-[#a044ff]">Kunjungan</span>
                        </h2>
                        <p class="text-gray-500 text-xs md:text-sm mt-1 hidden md:block">Kelola data tamu dan riwayat kunjungan.</p>
                    </div>
                </div>
                
            <a href="{{ route('guest.form') }}" class="w-full md:w-auto bg-gradient-to-r from-[#ff3366] to-[#a044ff] text-white px-6 py-3 rounded-xl md:rounded-2xl shadow-lg shadow-purple-200 font-bold hover:scale-105 transition-transform flex justify-center items-center gap-2 text-sm md:text-base">
                <i class="fas fa-plus"></i> Tambah Kunjungan
            </a>            </div>

            <div class="bg-white p-4 rounded-2xl md:rounded-[2rem] shadow-sm border border-gray-100 mb-6 flex flex-col md:flex-row gap-3 md:gap-4">
                <form action="{{ route('visits.index') }}" method="GET" class="relative flex-1 w-full">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / NIM..." 
                           class="w-full pl-10 pr-4 py-3 bg-gray-50 rounded-xl outline-none focus:ring-2 focus:ring-[#a044ff] focus:bg-white transition font-medium text-gray-700 text-sm">
                </form>
                
                <div class="w-full md:w-auto">
                    <select onchange="window.location.href=this.value" class="w-full md:w-72 bg-gray-50 px-4 py-3 rounded-xl text-gray-600 font-bold outline-none cursor-pointer hover:bg-gray-100 transition text-sm text-ellipsis overflow-hidden">
                        <option value="{{ route('visits.index') }}">Semua Prodi</option>
                        
                        <option value="{{ route('visits.index', ['prodi' => 'D3 Teknik Listrik']) }}" 
                            {{ request('prodi') == 'D3 Teknik Listrik' ? 'selected' : '' }}>
                            D3 Teknik Listrik
                        </option>
                        
                        <option value="{{ route('visits.index', ['prodi' => 'D3 Teknik Elektronika']) }}" 
                            {{ request('prodi') == 'D3 Teknik Elektronika' ? 'selected' : '' }}>
                            D3 Teknik Elektronika
                        </option>
                        
                        <option value="{{ route('visits.index', ['prodi' => 'D3 Teknik Informatika']) }}" 
                            {{ request('prodi') == 'D3 Teknik Informatika' ? 'selected' : '' }}>
                            D3 Teknik Informatika
                        </option>
                        
                        <option value="{{ route('visits.index', ['prodi' => 'D4 Teknologi Rekayasa Pembangkit Energi']) }}" 
                            {{ request('prodi') == 'D4 Teknologi Rekayasa Pembangkit Energi' ? 'selected' : '' }}>
                            D4 Teknologi Rekayasa Pembangkit Energi
                        </option>
                        
                        <option value="{{ route('visits.index', ['prodi' => 'D4 Sistem Informasi Kota Cerdas']) }}" 
                            {{ request('prodi') == 'D4 Sistem Informasi Kota Cerdas' ? 'selected' : '' }}>
                            D4 Sistem Informasi Kota Cerdas
                        </option>

                        <option value="{{ route('visits.index', ['prodi' => 'Lainnya']) }}" 
                            {{ request('prodi') == 'Lainnya' ? 'selected' : '' }}>
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

                                        <button onclick='editData(@json($v))' class="w-8 h-8 rounded-lg flex items-center justify-center bg-yellow-50 text-yellow-500 hover:bg-yellow-400 hover:text-white transition-all shadow-sm" title="Edit Data">
                                            <i class="fas fa-pencil-alt text-xs"></i>
                                        </button>
                                        
                                        <form action="{{ route('visits.destroy', $v->id) }}" method="POST" class="delete-form inline-block">
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

<div id="modalForm" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0 p-4">
    <div class="bg-white w-full md:max-w-lg rounded-2xl md:rounded-[2rem] p-5 md:p-8 shadow-2xl transform scale-95 transition-transform duration-300 relative max-h-[90vh] overflow-y-auto" id="modalContent">
        
        <div class="flex justify-between items-center mb-5 md:mb-6">
            <h3 id="modalTitle" class="text-lg md:text-xl font-extrabold text-gray-800">Tambah Kunjungan</h3>
            <button onclick="closeModal()" class="w-8 h-8 rounded-full bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-500 flex items-center justify-center transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="formVisit" action="{{ route('visits.store') }}" method="POST">
            @csrf
            <div id="methodPut"></div> 
            
            <div class="space-y-3 md:space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" id="inputNama" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border-none focus:ring-2 focus:ring-purple-200 focus:bg-white transition text-sm font-bold text-gray-800" placeholder="Masukkan nama...">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">NIM / NIK</label>
                        <input type="text" name="nomor_induk" id="inputNim" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border-none focus:ring-2 focus:ring-purple-200 focus:bg-white transition text-sm font-bold text-gray-800">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Prodi</label>
                        <select name="prodi" id="inputProdi" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-none focus:ring-2 focus:ring-purple-200 focus:bg-white transition text-sm font-bold text-gray-800">
                            <option value="" disabled selected>Pilih Prodi...</option>
                            <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                            <option value="D3 Teknik Elektronika">D3 Teknik Elektronika</option>
                            <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                            <option value="D4 Teknologi Rekayasa Pembangkit Energi">D4 Teknologi Rekayasa Pembangkit Energi</option>
                            <option value="D4 Sistem Informasi Kota Cerdas">D4 Sistem Informasi Kota Cerdas</option>
                            <option value="Lainnya">Lainnya / Umum</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Keperluan</label>
                    <textarea name="keperluan" id="inputKeperluan" rows="3" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border-none focus:ring-2 focus:ring-purple-200 focus:bg-white transition text-sm font-bold text-gray-800 placeholder-gray-400" placeholder="Tujuan kunjungan..."></textarea>
                </div>
            </div>

            <div class="mt-6 md:mt-8 flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 px-4 py-3 rounded-xl bg-gray-100 text-gray-600 font-bold hover:bg-gray-200 transition text-sm md:text-base">Batal</button>
                <button type="submit" class="flex-1 px-4 py-3 rounded-xl bg-gradient-to-r from-[#ff3366] to-[#a044ff] text-white font-bold hover:shadow-lg hover:shadow-purple-200 hover:scale-[1.02] transition-all text-sm md:text-base">Simpan</button>
            </div>
        </form>
    </div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // --- Javascript ---
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            background: '#fff',
            customClass: { popup: 'rounded-[2rem] p-6' }
        });
    @endif

    // Hapus Data
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            let form = this.closest('.delete-form');
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data kunjungan ini tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff3366',
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#fff',
                customClass: { 
                    popup: 'rounded-[2rem] p-6',
                    title: 'text-xl font-bold text-gray-800',
                    confirmButton: 'rounded-xl px-4 py-2 font-bold',
                    cancelButton: 'rounded-xl px-4 py-2 font-bold text-gray-700'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // --- Logika Modal Tambah/Edit ---
    const modal = document.getElementById('modalForm');
    const modalContent = document.getElementById('modalContent');
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('formVisit');

    function openModal(mode) {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);

        if (mode === 'add') {
            modalTitle.innerText = 'Tambah Kunjungan';
            form.action = "{{ route('visits.store') }}"; 
            form.reset(); 
            document.getElementById('methodPut').innerHTML = ''; 
        }
    }

    function editData(data) {
        openModal('edit'); 
        modalTitle.innerText = 'Edit Kunjungan';
        let url = "{{ route('visits.update', ':id') }}";
        url = url.replace(':id', data.id);
        form.action = url;
        document.getElementById('methodPut').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('inputNama').value = data.nama;
        document.getElementById('inputNim').value = data.nomor_induk;
        document.getElementById('inputProdi').value = data.prodi;
        document.getElementById('inputKeperluan').value = data.keperluan;
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // --- Logika Modal DETAIL ---
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