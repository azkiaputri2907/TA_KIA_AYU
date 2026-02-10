<aside :class="sideBarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-[#ff3366] via-[#a044ff] to-[#3366ff] 
              lg:m-4 lg:relative lg:translate-x-0 lg:rounded-3xl text-white flex flex-col shadow-2xl transition-transform duration-300 ease-in-out">
    
    <div class="p-8 flex justify-between items-center">
        <div>
            <h1 class="font-bold text-2xl tracking-tight leading-none">Buku Tamu</h1>
            <p class="text-[10px] opacity-80 uppercase tracking-[0.2em] mt-2 font-medium">Jurusan Teknik Elektro</p>
        </div>
        <button @click="sideBarOpen = false" class="lg:hidden text-white"><i class="fas fa-times text-xl"></i></button>
    </div>

    <div class="mx-6 p-4 bg-white/10 rounded-2xl flex items-center gap-3 mb-8 border border-white/5">
        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center shrink-0">
            <i class="fas fa-user-circle text-xl"></i>
        </div>
        <div class="truncate">
            <p class="text-sm font-bold truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
            <p class="text-[10px] opacity-60 uppercase tracking-tighter">Online</p>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
        <a href="{{ route('ketua.dashboardkajur') }}" 
           class="flex items-center gap-3 py-3 px-4 rounded-xl {{ Request::is('ketua') ? 'bg-white text-[#a044ff] font-bold shadow-lg' : 'opacity-70 hover:opacity-100 hover:bg-white/5 transition' }}">
            <i class="fas fa-th-large w-5"></i> <span>Dashboard</span>
        </a>
        
        <a href="{{ route('ketua.data_kunjungan') }}" 
        class="flex items-center gap-3 py-3 px-4 rounded-xl {{ Request::routeIs('ketua.data_kunjungan') ? 'bg-white text-[#a044ff] font-bold shadow-lg' : 'opacity-70 hover:opacity-100 hover:bg-white/5 transition' }}">
            <i class="fas fa-file-alt w-5"></i> <span>Data Kunjungan</span>
        </a>
        
        <a href="{{ route('ketua.survey.index') }}" 
        class="flex items-center gap-3 py-3 px-4 rounded-xl {{ Request::routeIs('ketua.survey.index') ? 'bg-white text-[#a044ff] font-bold shadow-lg' : 'opacity-70 hover:opacity-100 hover:bg-white/5 transition' }}">
            <i class="fas fa-poll w-5"></i> <span>Data Survey</span>
        </a>

        <a href="{{ route('ketua.laporan') }}" 
        class="flex items-center gap-3 py-3 px-4 rounded-xl transition {{ request()->routeIs('ketua.laporan') ? 'bg-white text-[#a044ff] font-bold shadow-lg' : 'opacity-70 hover:opacity-100 hover:bg-white/5 transition' }}">
            <i class="fas fa-chart-bar w-5"></i> 
            <span>Laporan & Statistik</span>
        </a>

    </nav>

    <div class="p-6 border-t border-white/10 mt-auto">
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="flex items-center gap-2 text-white/80 hover:text-white transition w-full">
        <i class="fas fa-sign-out-alt"></i> 
        <span class="font-medium text-sm">Logout</span>
    </button>
</form>
    </div>
</aside>