@extends('layout.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10 px-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
        
        <div class="bg-gradient-to-r from-pink-400 via-purple-400 to-blue-500 pb-16 md:pb-24 pt-6 px-4 sm:px-8 md:px-12 text-center text-white"> 
            <div class="bg-white/20 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-wide">Login Administrator</h1>
            <p class="text-sm opacity-90 mt-1">Buku Tamu Digital - Jurusan Teknik Elektro</p>
        </div>

        <div class="p-8 pt-6">
            @if($errors->any())
            <div class="mb-6 bg-red-50/80 border border-red-200 rounded-xl p-4 flex items-start gap-3 shadow-sm relative overflow-hidden group hover:bg-red-50 transition-colors">
                
                <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-red-400 to-red-600 rounded-l-xl"></div>

                <div class="shrink-0 text-red-500 mt-0.5 bg-white p-1.5 rounded-full shadow-sm border border-red-100">
                    @if($errors->has('role'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </div>

                <div class="flex-1">
                    <h3 class="text-sm font-bold text-red-800 tracking-wide">
                        @if($errors->has('role'))
                            Akses Ditolak
                        @else
                            Login Gagal
                        @endif
                    </h3>
                    <p class="text-xs text-red-600 mt-1 leading-relaxed font-medium">
                        {{ $errors->first() }}
                    </p>
                </div>

                <button onclick="this.parentElement.remove()" class="text-red-300 hover:text-red-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                
                <p class="text-sm font-semibold text-gray-600 mb-3">Login Sebagai</p>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <label class="cursor-pointer relative">
                        <input type="radio" name="role" value="admin" class="peer hidden" checked>
                        <div class="border-2 border-gray-100 rounded-xl p-4 text-center transition-all duration-200 hover:bg-gray-50 peer-checked:border-pink-500 peer-checked:bg-pink-50 peer-checked:shadow-sm">
                            <span class="block font-bold text-gray-700 peer-checked:text-pink-600 transition-colors">Admin Prodi</span>
                            <span class="text-xs text-gray-400 block mt-1">Jurusan Teknik Elektro</span>
                        </div>
                        <div class="absolute top-2 right-2 text-pink-500 hidden peer-checked:block">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                    </label>

                    <label class="cursor-pointer relative">
                        <input type="radio" name="role" value="ketua" class="peer hidden">
                        <div class="border-2 border-gray-100 rounded-xl p-4 text-center transition-all duration-200 hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:shadow-sm">
                            <span class="block font-bold text-gray-700 peer-checked:text-blue-600 transition-colors">Ketua</span>
                            <span class="text-xs text-gray-400 block mt-1">Jurusan Teknik Elektro</span>
                        </div>
                         <div class="absolute top-2 right-2 text-blue-500 hidden peer-checked:block">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                    </label>
                </div>

                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="email" name="email" class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" placeholder="Masukkan email anda" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-pink-400 via-purple-400 to-blue-500 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-xl hover:opacity-95 transform transition hover:-translate-y-0.5 duration-200">
                    Masuk
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('landing') }}" class="text-sm text-gray-400 hover:text-blue-600 transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Halaman Tamu
                </a>
            </div>
        </div>
    </div>
</div>
@endsection