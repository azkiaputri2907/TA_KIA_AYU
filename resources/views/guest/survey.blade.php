@extends('layout.main')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 flex flex-col items-center">
    
    <div class="max-w-3xl w-full text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Survey Kepuasan Pelayanan</h1>
        <p class="text-gray-500 mt-2">Jurusan Teknik Elektro</p>
    </div>

    <div class="max-w-3xl w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-purple-600 p-6 text-white text-center">
            <p class="text-lg">Halo, <b>{{ $visit->nama }}</b></p>
            <p class="text-sm opacity-80">Mohon berikan penilaian jujur Anda terhadap pelayanan kami hari ini.</p>
        </div>

        <form action="{{ route('guest.storeSurvey') }}" method="POST" class="p-8">
            @csrf
            <input type="hidden" name="visit_id" value="{{ $visit->id }}">

            <div class="mb-8 border-b border-gray-100 pb-6">
                <label class="block text-gray-700 font-bold mb-3">1. Bagaimana kecepatan pelayanan administrasi kami?</label>
                <div class="flex justify-between items-center max-w-md mx-auto">
                    <span class="text-xs text-gray-400">Lambat</span>
                    <div class="flex space-x-4">
                        @for($i=1; $i<=5; $i++)
                        <label class="cursor-pointer flex flex-col items-center group">
                            <input type="radio" name="kecepatan" value="{{ $i }}" class="peer sr-only" required>
                            <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-400 peer-checked:border-purple-500 peer-checked:bg-purple-500 peer-checked:text-white transition-all group-hover:border-purple-300">
                                {{ $i }}
                            </div>
                        </label>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-400">Cepat</span>
                </div>
            </div>

            <div class="mb-8 border-b border-gray-100 pb-6">
                <label class="block text-gray-700 font-bold mb-3">2. Bagaimana keramahan petugas/staff kami?</label>
                <div class="flex justify-between items-center max-w-md mx-auto">
                    <span class="text-xs text-gray-400">Judess</span>
                    <div class="flex space-x-4">
                        @for($i=1; $i<=5; $i++)
                        <label class="cursor-pointer flex flex-col items-center group">
                            <input type="radio" name="keramahan" value="{{ $i }}" class="peer sr-only" required>
                            <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-400 peer-checked:border-pink-500 peer-checked:bg-pink-500 peer-checked:text-white transition-all group-hover:border-pink-300">
                                {{ $i }}
                            </div>
                        </label>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-400">Ramah</span>
                </div>
            </div>

            <div class="mb-8 border-b border-gray-100 pb-6">
                <label class="block text-gray-700 font-bold mb-3">3. Apakah informasi yang diberikan jelas & solutif?</label>
                <div class="flex justify-between items-center max-w-md mx-auto">
                    <span class="text-xs text-gray-400">Bingung</span>
                    <div class="flex space-x-4">
                        @for($i=1; $i<=5; $i++)
                        <label class="cursor-pointer flex flex-col items-center group">
                            <input type="radio" name="kejelasan" value="{{ $i }}" class="peer sr-only" required>
                            <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-400 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white transition-all group-hover:border-blue-300">
                                {{ $i }}
                            </div>
                        </label>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-400">Sangat Jelas</span>
                </div>
            </div>

            <div class="mb-8 border-b border-gray-100 pb-6">
                <label class="block text-gray-700 font-bold mb-3">4. Kenyamanan ruang tunggu & fasilitas?</label>
                <div class="flex justify-between items-center max-w-md mx-auto">
                    <span class="text-xs text-gray-400">Buruk</span>
                    <div class="flex space-x-4">
                        @for($i=1; $i<=5; $i++)
                        <label class="cursor-pointer flex flex-col items-center group">
                            <input type="radio" name="kenyamanan" value="{{ $i }}" class="peer sr-only" required>
                            <div class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-400 peer-checked:border-green-500 peer-checked:bg-green-500 peer-checked:text-white transition-all group-hover:border-green-300">
                                {{ $i }}
                            </div>
                        </label>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-400">Nyaman</span>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-gray-700 font-bold mb-2">Kritik & Saran</label>
                <textarea name="feedback" rows="3" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:outline-none" placeholder="Tulis masukan Anda agar kami bisa lebih baik..."></textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    Kirim Penilaian
                </button>
            </div>
        </form>
    </div>
</div>
@endsection