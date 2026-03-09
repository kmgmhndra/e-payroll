<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="opacity-90 mb-4">Selamat datang di E-Payroll Kemenkumham Bali.</p>
                        <div class="inline-block bg-white/20 px-3 py-1 rounded-lg text-sm">
                            NIP: {{ Auth::user()->nip }}
                        </div>
                    </div>
                    <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-10 translate-y-10">
                        <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center">
                    <div class="h-12 w-12 bg-gray-100 rounded-full flex items-center justify-center mb-3 text-xl">
                        ⚙️
                    </div>
                    <h4 class="font-bold text-gray-800">Pengaturan Akun</h4>
                    <p class="text-xs text-gray-500 mb-4">Ubah profil & kata sandi</p>
                    <a href="{{ route('profile') }}" class="px-4 py-2 bg-gray-800 text-white text-sm rounded-lg hover:bg-gray-700 transition w-full">
                        Edit Profil
                    </a>
                </div>
            </div>

            @if($latestSalary)
            <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">
                <div class="bg-blue-50/50 px-6 py-4 border-b border-blue-100 flex justify-between items-center">
                    <h3 class="font-bold text-blue-800 flex items-center gap-2">
                        📄 Slip Gaji Terbaru
                    </h3>
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                        {{ $latestSalary->month }} {{ $latestSalary->year }}
                    </span>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
                        <p class="text-xl font-bold text-green-600">Rp {{ number_format($latestSalary->total_income, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Potongan</p>
                        <p class="text-xl font-bold text-red-500">Rp {{ number_format($latestSalary->total_deduction, 0, ',', '.') }}</p>
                    </div>
                    <div class="md:text-right">
                        <p class="text-sm text-gray-500 mb-1">Gaji Bersih (Take Home Pay)</p>
                        <p class="text-2xl font-extrabold text-gray-900 mb-3">Rp {{ number_format($latestSalary->take_home_pay, 0, ',', '.') }}</p>
                        
                        <a href="{{ route('admin.salary.print', $latestSalary->id) }}" 
                           download="Slip_Gaji_{{ $latestSalary->month }}_{{ $latestSalary->year }}.pdf" 
                           class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                    <h3 class="font-bold text-gray-800 text-lg">Riwayat Gaji</h3>
                    
                    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                        <select name="filter_month" class="rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Semua Bulan --</option>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                <option value="{{ $bulan }}" {{ request('filter_month') == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>

                        <select name="filter_year" class="rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}" {{ request('filter_year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Cari
                        </button>

                        @if(request('filter_month') || request('filter_year'))
                            <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 rounded-l-lg">Periode</th>
                                <th class="px-6 py-3">Gaji Bersih</th>
                                <th class="px-6 py-3 rounded-r-lg text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($salaries as $salary)
                            <tr class="bg-white border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $salary->month }} {{ $salary->year }}
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Rp {{ number_format($salary->take_home_pay, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{-- BAGIAN INI DIBIARKAN target="_blank" SESUAI REQUEST --}}
                                    <a href="{{ route('admin.salary.print', $salary->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                                        Lihat / Download
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                                    @if(request('filter_month') || request('filter_year'))
                                        <div class="flex flex-col items-center">
                                            <svg class="w-10 h-10 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Slip gaji tidak ditemukan untuk filter ini.
                                        </div>
                                    @else
                                        Belum ada riwayat gaji.
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>