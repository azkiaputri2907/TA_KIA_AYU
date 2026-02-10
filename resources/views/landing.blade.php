@extends('layout.main')

@section('content')
<div class="min-h-screen bg-white font-sans text-gray-800 antialiased">
    
    <section class="relative bg-gradient-to-r from-pink-400 via-purple-400 to-blue-500 pb-16 md:pb-24 pt-6 px-4 sm:px-8 md:px-12 overflow-hidden">
        <nav class="flex justify-between items-center max-w-7xl mx-auto mb-10 md:mb-20">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-white/20 rounded-lg backdrop-blur-md flex items-center justify-center border border-white/20">
                    <img src="{{ asset('img/logo_poliban.png') }}" alt="Logo Poliban" class="w-full h-full object-contain">
                </div>
                <div class="leading-tight">
                    <span class="text-white font-bold text-lg md:text-xl block tracking-wide">Jurusan Teknik Elektro</span>
                </div>
            </div>
            <a href="{{ route('login') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-md text-white px-5 py-2 rounded-full flex items-center gap-2 transition border border-white/30 text-xs md:text-sm">
                Login Admin <span>→</span>
            </a>
        </nav>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
    
    <div class="text-white space-y-6 text-center lg:text-left order-1 lg:order-1">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight tracking-tight">
            Buku Tamu <br> <span class="opacity-80 text-blue-100 italic">Digital</span>
        </h1>
        <p class="text-base sm:text-lg font-semibold opacity-90">Jurusan Teknik Elektro</p>
        <p class="max-w-md mx-auto lg:mx-0 opacity-80 leading-relaxed text-sm md:text-base">
            Sistem pencatatan tamu modern yang efisien, aman, dan mudah digunakan untuk meningkatkan pelayanan administrasi.
        </p>
        <div class="pt-4 flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
            <a href="{{ route('guest.form') }}" class="inline-flex justify-center items-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-bold shadow-xl hover:bg-blue-50 transition transform hover:-translate-y-1 active:scale-95 relative z-10">
                Mulai Catat Kunjungan <span class="text-xl">→</span>
            </a>
        </div>
    </div>

    <div class="relative order-2 lg:order-2 w-full max-w-md mx-auto">
        <div class="bg-white/20 backdrop-blur-xl border border-white/30 rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-8 shadow-2xl">
            <div class="flex justify-center mb-6 md:mb-8">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-pink-400 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-3xl md:text-4xl text-white">📖</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3 md:gap-4">
                <div class="bg-blue-400/30 p-3 md:p-4 rounded-xl text-center backdrop-blur-md border border-white/20">
                    <p class="text-xl md:text-2xl font-bold text-white">{{ number_format($kunjunganBulanIni) }}</p>
                    <p class="text-[8px] md:text-[10px] text-blue-50 uppercase tracking-wider">Kunjungan</p>
                </div>
                
                <div class="bg-blue-400/30 p-3 md:p-4 rounded-xl text-center backdrop-blur-md border border-white/20">
                    <p class="text-xl md:text-2xl font-bold text-white">{{ number_format($totalKunjungan) }}</p>
                    <p class="text-[8px] md:text-[10px] text-blue-50 uppercase tracking-wider">Total Tamu</p>
                </div>

                <div class="bg-blue-400/30 p-3 md:p-4 rounded-xl text-center backdrop-blur-md border border-white/20">
                    <p class="text-xl md:text-2xl font-bold text-white">99%</p>
                    <p class="text-[8px] md:text-[10px] text-blue-50 uppercase tracking-wider">Data Valid</p>
                </div>
                <div class="bg-blue-400/30 p-3 md:p-4 rounded-xl text-center backdrop-blur-md border border-white/20">
                    <p class="text-xl md:text-2xl font-bold text-white">24/7</p>
                    <p class="text-[8px] md:text-[10px] text-blue-50 uppercase tracking-wider">Sistem Aktif</p>
                </div>
            </div>
        </div>
    </div>

</div>

        <div class="absolute bottom-0 left-0 w-full leading-none overflow-hidden">
            <svg class="relative block w-full h-[40px] md:h-[60px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                
                <div class="order-2 lg:order-1 space-y-8">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="h-px w-8 bg-blue-600"></span>
                            <p class="text-blue-600 font-bold uppercase tracking-widest text-xs">Tentang Sistem</p>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 leading-tight">
                            Mengapa Menggunakan <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-600">
                                Buku Tamu Digital?
                            </span>
                        </h2>
                        <p class="text-gray-600 leading-relaxed text-sm md:text-base mt-4">
                            Jurusan Teknik Elektro berkomitmen untuk mengadopsi teknologi digital dalam setiap aspek pelayanan. Buku Tamu Digital adalah implementasi nyata dari visi modernisasi administrasi yang efisien dan berkelanjutan.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div class="flex items-start gap-3 group">
                            <div class="w-8 h-8 flex-shrink-0 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center transition-colors group-hover:bg-pink-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium leading-snug">Menghilangkan buku tamu manual yang rentan rusak</span>
                        </div>
                        
                        <div class="flex items-start gap-3 group">
                            <div class="w-8 h-8 flex-shrink-0 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium leading-snug">Data tamu tersimpan digital & mudah dicari</span>
                        </div>

                        <div class="flex items-start gap-3 group">
                            <div class="w-8 h-8 flex-shrink-0 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center transition-colors group-hover:bg-pink-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium leading-snug">Mengurangi penggunaan kertas (Paperless)</span>
                        </div>

                        <div class="flex items-start gap-3 group">
                            <div class="w-8 h-8 flex-shrink-0 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium leading-snug">Statistik kunjungan real-time untuk evaluasi</span>
                        </div>

                        <div class="flex items-start gap-3 group">
                            <div class="w-8 h-8 flex-shrink-0 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center transition-colors group-hover:bg-pink-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium leading-snug">Meningkatkan citra profesional jurusan</span>
                        </div>

                        <div class="flex items-start gap-3 group">
                            <div class="w-8 h-8 flex-shrink-0 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium leading-snug">Integrasi data yang aman dan terpusat</span>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 flex flex-col gap-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-pink-500 to-rose-600 text-white p-6 rounded-3xl shadow-xl transform hover:scale-105 transition duration-300 h-full">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm">
                                    <span class="text-2xl">📈</span>
                                </div>
                            </div>
                            <div class="mt-auto">
    <p class="text-4xl font-bold mb-1">
        {{ $efisiensiAdmin }}%
    </p>
    <p class="text-[10px] opacity-90 uppercase tracking-widest font-semibold">
        Efisiensi Admin
    </p>
</div>

                        </div>

                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white p-6 rounded-3xl shadow-xl transform hover:scale-105 transition duration-300 h-full">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-sm">
                                    <span class="text-2xl">🏅</span>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <p class="text-4xl font-bold mb-1">{{ number_format($totalRating, 1) }}</p>
                                <p class="text-[10px] opacity-90 uppercase tracking-widest font-semibold">Rating Layanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100 flex items-center justify-between relative overflow-hidden group">
                        <div class="relative z-10">
                            <p class="text-gray-500 text-xs uppercase tracking-wider font-bold mb-1">Kunjungan Hari Ini</p>
                            <p class="text-3xl font-extrabold text-gray-800">{{ number_format($kunjunganHariIni) }} <span class="text-sm font-normal text-gray-400">Tamu</span></p>
                        </div>
                        <div class="relative z-10 w-12 h-12 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center text-xl">
                            ⚡
                        </div>
                        <div class="absolute right-0 top-0 w-24 h-full bg-gradient-to-l from-pink-50 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="text-center mb-16">
                <p class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-2">Struktur Organisasi</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Jurusan Teknik Elektro</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-pink-500 to-blue-500 mx-auto rounded-full mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-16">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-xl hover:shadow-2xl transition-all text-center group">
                    <div class="relative w-32 h-32 md:w-40 md:h-40 mx-auto mb-6">
                        <div class="absolute inset-0 bg-red-600 rounded-full scale-105 group-hover:scale-110 transition-transform"></div>
                        <img src="{{ asset('img/pimpinan/kajur.png') }}" alt="Ketua Jurusan" class="relative w-full h-full object-cover rounded-full border-4 border-white">
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800">M. Helmy Noor, S.ST., M.T.</h3>
                    <p class="text-pink-500 font-semibold text-sm">Ketua Jurusan</p>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-xl hover:shadow-2xl transition-all text-center group">
                    <div class="relative w-32 h-32 md:w-40 md:h-40 mx-auto mb-6">
                        <div class="absolute inset-0 bg-red-600 rounded-full scale-105 group-hover:scale-110 transition-transform"></div>
                        <img src="{{ asset('img/pimpinan/sekjur.png') }}" alt="Sekretaris Jurusan" class="relative w-full h-full object-cover rounded-full border-4 border-white">
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800">Rully Rezki Saputra, S.Pd., M.Pd.</h3>
                    <p class="text-blue-500 font-semibold text-sm">Sekretaris Jurusan</p>
                </div>
            </div>

            <div class="text-center mb-10">
                <span class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Koordinator Program Studi</span>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="text-center group">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <div class="absolute inset-0 bg-red-600 rounded-full group-hover:rotate-12 transition-transform"></div>
                        <img src="{{ asset('img/pimpinan/kaprodi1.png') }}" class="relative w-full h-full object-cover rounded-full border-2 border-white">
                    </div>
                    <h4 class="text-xs font-bold text-gray-800 leading-tight">Ir. Lauhil Mahfudz H., S.T, M.T.</h4>
                    <p class="text-[10px] text-gray-500 mt-1">D3 Teknik Listrik</p>
                </div>

                <div class="text-center group">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <div class="absolute inset-0 bg-red-600 rounded-full group-hover:rotate-12 transition-transform"></div>
                        <img src="{{ asset('img/pimpinan/kaprodi2.png') }}" class="relative w-full h-full object-cover rounded-full border-2 border-white">
                    </div>
                    <h4 class="text-xs font-bold text-gray-800 leading-tight">Khairunnisa, S.T., M.T.</h4>
                    <p class="text-[10px] text-gray-500 mt-1">D3 Teknik Elektronika</p>
                </div>

                <div class="text-center group">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <div class="absolute inset-0 bg-red-600 rounded-full group-hover:rotate-12 transition-transform"></div>
                        <img src="{{ asset('img/pimpinan/kaprodi3.png') }}" class="relative w-full h-full object-cover rounded-full border-2 border-white">
                    </div>
                    <h4 class="text-xs font-bold text-gray-800 leading-tight">Fuad Sholihin, S.T., M.Kom.</h4>
                    <p class="text-[10px] text-gray-500 mt-1">D3 Teknik Informatika</p>
                </div>

                <div class="text-center group">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <div class="absolute inset-0 bg-red-600 rounded-full group-hover:rotate-12 transition-transform"></div>
                        <img src="{{ asset('img/pimpinan/kaprodi4.png') }}" class="relative w-full h-full object-cover rounded-full border-2 border-white">
                    </div>
                    <h4 class="text-xs font-bold text-gray-800 leading-tight">Zuraidah, S.T., M.T.</h4>
                    <p class="text-[10px] text-gray-500 mt-1">D4 Tek. Rek. Pembangkit Energi</p>
                </div>

                <div class="text-center group flex flex-col items-center col-span-2 lg:col-span-1">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <div class="absolute inset-0 bg-red-600 rounded-full group-hover:rotate-12 transition-transform"></div>
                        <img src="{{ asset('img/pimpinan/kaprodi5.png') }}" class="relative w-full h-full object-cover rounded-full border-2 border-white">
                    </div>
                    <h4 class="text-xs font-bold text-gray-800 leading-tight">Subandi, S.T., M.Kom.</h4>
                    <p class="text-[10px] text-gray-500 mt-1">D4 Sistem Informasi Kota Cerdas</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#0a1128] text-gray-400 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <div class="text-left md:text-left">
                <div class="flex items-left justify-left md:justify-start gap-3 mb-6">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-left justify-left text-blue-900 font-bold text-xl">
                        <img src="{{ asset('img/logo_poliban.png') }}" alt="Logo Poliban" class="w-full h-full object-contain filter drop-shadow-md">
                    </div>
                    <div class="text-left">
                        <h4 class="text-white font-bold leading-none">Jurusan Teknik Elektro</h4>
                        <p class="text-[10px] uppercase tracking-tighter">Politeknik Negeri Banjarmasin</p>
                    </div>
                </div>
                <p class="text-xs leading-relaxed mb-6">Visi : Mewujudkan jurusan teknik elektro yang UNGGUL dalam menghasilkan INOVASI PRODUK bidang sains terapan untuk kemandirian tata kelola keuangan BADAN LAYANAN UMUM (BLU).</p>
                <p class="text-xs leading-relaxed mb-6">Misi : <br> 1. Peningkatan mutu lulusan serta optimasi suasana akademik sesuai standar nasional dan kebutuhan dunia usaha, dunia industri, dan dunia kerja (DUDIKA); <br> 2. Peningkatan keahlian sumber daya manusia yang diakui pada tingkat nasional; <br> 3. Pembuatan inovasi produk dari penelitian atau keilmuan yang diterapkan kepada masyarakat; <br> 4. Peningkatan kerjasama nasional dan internasional sebagai upaya branding jurusan teknik elektro ke masyarakat; </p>

                <div class="flex justify-center md:justify-start gap-3">
                    <a href="https://web.facebook.com/poliban.ac.id" target="_blank" 
                    class="w-9 h-9 bg-[#1877F2] rounded-full flex items-center justify-center text-white hover:scale-110 hover:shadow-lg transition-all duration-300">
                        <i class="fa-brands fa-facebook-f text-sm"></i>
                    </a>

                    <a href="https://www.instagram.com/poliban_official/" target="_blank" 
                    class="w-9 h-9 bg-gradient-to-tr from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] rounded-full flex items-center justify-center text-white hover:scale-110 hover:shadow-lg transition-all duration-300">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>

                    <a href="https://x.com/humaspoliban" target="_blank" 
                    class="w-9 h-9 bg-black rounded-full flex items-center justify-center text-white hover:scale-110 hover:shadow-lg transition-all duration-300">
                        <i class="fa-brands fa-x-twitter text-sm"></i>
                    </a>

                    <a href="https://www.youtube.com/channel/UC5CfzvUTqEUPXhwwSLvP53Q" target="_blank" 
                    class="w-9 h-9 bg-[#FF0000] rounded-full flex items-center justify-center text-white hover:scale-110 hover:shadow-lg transition-all duration-300">
                        <i class="fa-brands fa-youtube text-sm"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 border-l-4 border-pink-500 pl-3">Kontak Kami</h4>
                <div class="space-y-3 text-xs">
                    <p>📞 Phone / Fax: (0511) 330 5052</p>
                    <p>📧 Email: info@poliban.ac.id</p>
                    <p>📍 Jl. Brigjen H. Hasan Basri, Kayu Tangi , Banjarmasin 70123</p>
                </div>
            </div>

            <div class="space-y-4">
                <h4 class="text-white font-bold mb-6 border-l-4 border-blue-500 pl-3">Jam Operasional</h4>
                @foreach([['Senin - Jumat', '08:00 - 15:00', 'blue'], ['Sabtu - Minggu', 'Tutup', 'red']] as $jam)
                <div class="flex justify-between items-center bg-white/5 p-3 rounded-lg text-xs border border-white/5">
                    <span>{{$jam[0]}}</span>
                    <span class="bg-{{$jam[2]}}-600 text-white text-[9px] px-2 py-0.5 rounded">{{$jam[1]}}</span>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 sm:px-8 mt-12 md:mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px]">
            <p>&copy; 2026 Jurusan Teknik Elektro. Guest Book System.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition">Privasi</a>
                <a href="#" class="hover:text-white transition">Bantuan</a>
            </div>
        </div>
    </footer>
</div>
@endsection