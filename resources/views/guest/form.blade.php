@extends('layout.main')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-pink-400 via-purple-400 to-blue-500 py-8 px-4 sm:px-6 lg:px-8 flex items-center justify-center font-sans">
            
            <div class="w-full max-w-4xl space-y-6">
                
                <div class="flex flex-col items-start w-full space-y-4"> <a href="{{ route('landing') }}" class="group inline-flex items-center px-4 py-2 rounded-full bg-white/20 text-white text-sm hover:bg-white/30 transition-all backdrop-blur-sm border border-white/20 shadow-sm">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>

            <div class="text-left"> <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow-md">
                    Buku Tamu Digital
                </h1>
                <p class="text-white/90 mt-2 text-sm md:text-base font-medium tracking-wide drop-shadow-sm">
                    Jurusan Teknik Elektro - Politeknik Negeri Banjarmasin
                </p>
            </div>
        </div>
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/40 relative">
            
            <div class="h-1.5 bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 w-full"></div>

            <div class="p-6 md:p-10">
                
                <div class="bg-blue-50/60 border border-blue-100 rounded-2xl p-5 mb-8 transition-all hover:shadow-md hover:border-blue-200 group-hover:bg-blue-50">
                    <div class="flex items-start md:items-center mb-4 space-x-3">
                        <div class="bg-white text-blue-500 p-2 rounded-lg shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm md:text-base">Sudah Pernah Berkunjung?</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Masukkan NIM/NIP/NIK untuk mengisi data otomatis.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="text" id="search_visitor" placeholder="Masukkan NIM / NIP..." class="flex-1 px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all text-sm md:text-base shadow-sm bg-white">
                        <button type="button" onclick="searchVisitor()" class="bg-gradient-to-r from-pink-500 to-blue-500 hover:opacity-90 text-white px-6 py-3 rounded-xl font-bold shadow-md active:scale-95 transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span>Cari</span>
                        </button>
                    </div>
                </div>

                <form action="{{ route('guest.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        
                        <div class="space-y-6">
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Kunjungan</label>
                                <div class="relative">
                                    <input type="text" name="no_kunjungan" value="{{ $kodeOtomatis }}" readonly 
                                        class="w-full px-4 py-3 rounded-xl bg-gray-100 border border-gray-200 text-gray-500 font-mono font-bold cursor-not-allowed select-none focus:outline-none">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-pink-500">*</span></label>
                                <input name="nama" id="nama" type="text" required placeholder="Contoh: Budi Santoso" 
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all shadow-sm placeholder-gray-400">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NIM / NIP / NIK <span class="text-pink-500">*</span></label>
                                <input id="nomor_induk" name="nomor_induk" type="text" required placeholder="Nomor identitas..." 
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all shadow-sm uppercase placeholder-gray-400">
                                <p class="text-xs text-gray-400 mt-1 italic ml-1">Ketik huruf untuk Mahasiswa (Contoh: C0...)</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Hari, Tanggal</label>
                                <input type="text" value="{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}" readonly 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-600 cursor-default focus:outline-none font-medium">
                            </div>

                            <div class="relative">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi / Instansi <span class="text-pink-500">*</span></label>
                                <div class="relative">
                                    <select id="prodi" name="prodi" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 font-medium focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all appearance-none cursor-pointer shadow-sm">
                                        <option value="">-- Pilih Asal --</option>
                                        <option value="D3 Teknik Listrik">D3 Teknik Listrik</option>
                                        <option value="D3 Teknik Elektronika">D3 Teknik Elektronika</option>
                                        <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                                        <option value="D4 Teknologi Rekayasa Pembangkit Energi">D4 Teknologi Rekayasa Pembangkit Energi</option>
                                        <option value="D4 Sistem Informasi Kota Cerdas">D4 Sistem Informasi Kota Cerdas</option>
                                        <option value="Lainnya">Lainnya / Umum</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                             <div class="h-full">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Keperluan Kunjungan <span class="text-pink-500">*</span></label>
                                <textarea name="keperluan" id="keperluan" rows="3" required placeholder="Contoh: Bertemu Kaprodi..." 
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all resize-none shadow-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex flex-col-reverse sm:flex-row gap-4 border-t border-gray-100 mt-8">
                        <button type="reset" class="w-full sm:w-auto px-8 py-3.5 rounded-xl border border-gray-300 text-gray-600 font-bold hover:bg-gray-50 active:bg-gray-100 transition-all flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Reset
                        </button>
                        <button type="submit" class="w-full sm:flex-1 px-8 py-3.5 rounded-xl bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 text-white font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex justify-center items-center gap-2">
                            <span>Simpan Data Kunjungan</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </button>
                    </div>

                </form>
            </div>
        </div>
        
        <p class="text-center text-white/70 text-xs font-medium tracking-wider drop-shadow-sm">
            &copy; 2026 Digital Guestbook System &bull; Teknik Elektro
        </p>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputNIM = document.getElementById('nomor_induk');
        const selectProdi = document.getElementById('prodi');
        const searchInput = document.getElementById('search_visitor');
        const namaInput = document.getElementById('nama');

        const kodeProdi = {
            '01': 'D3 Teknik Listrik',
            '02': 'D3 Teknik Elektronika',
            '03': 'D3 Teknik Informatika',
            '04': 'D4 Teknologi Rekayasa Pembangkit Energi',
            '05': 'D4 Sistem Informasi Kota Cerdas'
        };

        inputNIM.addEventListener('input', function() {
            let val = this.value.toUpperCase();
            if (val.length === 0) { selectProdi.value = ""; return; }
            
            const firstChar = val.charAt(0);
            if (/^[A-Z]$/.test(firstChar)) {
                if (val.length >= 3) {
                    let kode = val.substring(1, 3);
                    if (kodeProdi[kode]) selectProdi.value = kodeProdi[kode];
                }
            } else {
                selectProdi.value = "Lainnya";
            }
        });

        // Search Logic
        window.searchVisitor = function() {
            let nim = searchInput.value;
            if(!nim) { alert("Masukkan NIM/NIP dulu!"); return; }

            const btn = document.querySelector('button[onclick="searchVisitor()"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<svg class="animate-spin w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            
            fetch(`/cek-tamu/${nim}`)
                .then(response => response.json())
                .then(data => {
                    btn.innerHTML = originalContent;
                    if(data.status === 'found') {
                        inputNIM.value = data.data.nomor_induk;
                        namaInput.value = data.data.nama;
                        inputNIM.dispatchEvent(new Event('input'));
                        alert(`Data ditemukan: ${data.data.nama}.`);
                    } else {
                        alert("Data belum pernah tercatat. Silakan isi manual.");
                        inputNIM.value = nim;
                        inputNIM.dispatchEvent(new Event('input'));
                    }
                })
                .catch(err => {
                    console.error(err);
                    btn.innerHTML = originalContent;
                });
        }
    });
</script>
@endsection