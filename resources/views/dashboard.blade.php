<x-app-layout>

    <div class="space-y-8">
        
        <!-- Welcome Banner -->
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-3xl p-8 md:p-10 shadow-2xl">
            <!-- Decorative Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-white rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="h-14 w-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-white">Selamat Datang Kembali!</h1>
                            <p class="text-lg text-blue-100 mt-1">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <p class="text-blue-100 text-base max-w-2xl">
                        Sistem Manajemen Slip Gaji Internal Kemenkumham Bali
                    </p>
                </div>
                
                <div class="flex flex-col gap-3">
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/30">
                        <p class="text-xs text-blue-100 font-medium">Periode Aktif</p>
                        <p class="text-lg font-bold text-white">{{ $currentMonthIndo }} {{ $currentYear }}</p>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-blue-100">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                        <span class="font-medium">Sistem Online</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Total Pegawai -->
            <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Total Pegawai</p>
                        <h3 class="text-4xl font-bold text-slate-900">{{ $totalPegawai }}</h3>
                    </div>
                    <div class="h-12 w-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-semibold">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                        </svg>
                        +{{ $newEmployeesThisMonth }}
                    </span>
                    <span class="text-xs text-slate-500 font-medium">Pegawai baru bulan ini</span>
                </div>
            </div>

            <!-- Card 2: Slip Terupload -->
            <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Slip Terupload</p>
                        <h3 class="text-4xl font-bold text-slate-900">{{ $slipPercentage }}<span class="text-2xl text-slate-500">%</span></h3>
                    </div>
                    <div class="h-12 w-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2 rounded-full transition-all duration-500" style="width: {{ $slipPercentage }}%"></div>
                    </div>
                    <p class="text-xs text-slate-500 font-medium">{{ $slipUploaded }} dari {{ $totalPegawai }} pegawai</p>
                </div>
            </div>

            <!-- Card 3: Slip Pending -->
            <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-amber-200 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Slip Pending</p>
                        <h3 class="text-4xl font-bold text-slate-900">{{ $slipPending }}</h3>
                    </div>
                    <div class="h-12 w-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-semibold">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"/>
                        </svg>
                        Perlu Tindak Lanjut
                    </span>
                </div>
            </div>

            <!-- Card 4: Status Sistem -->
            <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-lg hover:border-violet-200 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Status Sistem</p>
                        <h3 class="text-2xl font-bold text-emerald-600">Optimal</h3>
                    </div>
                    <div class="h-12 w-12 bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl flex items-center justify-center shadow-lg shadow-violet-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                        <span class="text-xs text-slate-600 font-medium">Database</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                        <span class="text-xs text-slate-600 font-medium">Storage</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Quick Actions - Full Width on Mobile, 2 Cols on Desktop -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800">Aksi Cepat</h4>
                    </div>
                    <span class="text-xs text-slate-500 font-medium">Shortcut Menu</span>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    
                    <a href="{{ route('admin.import') }}" class="group flex flex-col items-center justify-center p-6 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-2xl hover:from-blue-100 hover:to-blue-200/50 transition-all duration-300 border border-blue-200 hover:shadow-lg hover:shadow-blue-200/50">
                        <div class="h-12 w-12 bg-blue-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-blue-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-blue-900 text-center">Upload Slip</span>
                        <span class="text-xs text-blue-600 mt-1">Gaji Bulanan</span>
                    </a>
                    
                    <a href="{{ route('admin.users') }}" class="group flex flex-col items-center justify-center p-6 bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-2xl hover:from-emerald-100 hover:to-emerald-200/50 transition-all duration-300 border border-emerald-200 hover:shadow-lg hover:shadow-emerald-200/50">
                        <div class="h-12 w-12 bg-emerald-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-emerald-900 text-center">Tambah Pegawai</span>
                        <span class="text-xs text-emerald-600 mt-1">Data Baru</span>
                    </a>
                    
                    <a href="{{ route('admin.arsip') }}" class="group flex flex-col items-center justify-center p-6 bg-gradient-to-br from-violet-50 to-violet-100/50 rounded-2xl hover:from-violet-100 hover:to-violet-200/50 transition-all duration-300 border border-violet-200 hover:shadow-lg hover:shadow-violet-200/50">
                        <div class="h-12 w-12 bg-violet-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-violet-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-violet-900 text-center">Arsip Gaji</span>
                        <span class="text-xs text-violet-600 mt-1">Laporan Bulanan</span>
                    </a>
                    
                    <a href="{{ route('profile') }}" class="group flex flex-col items-center justify-center p-6 bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-2xl hover:from-amber-100 hover:to-amber-200/50 transition-all duration-300 border border-amber-200 hover:shadow-lg hover:shadow-amber-200/50">
                        <div class="h-12 w-12 bg-amber-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-lg shadow-amber-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-amber-900 text-center">Profile</span>
                        <span class="text-xs text-amber-600 mt-1">Pengaturan Akun</span>
                    </a>
                    
                </div>
            </div>

            <!-- Information Card -->
            <div class="bg-gradient-to-br from-amber-50 via-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-200 shadow-sm">
                <div class="flex items-start gap-3 mb-4">
                    <div class="h-10 w-10 bg-amber-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-amber-500/30">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-amber-900">Panduan Singkat</h4>
                        <p class="text-xs text-amber-700 mt-0.5">Informasi Penting</p>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-start gap-3 bg-white/70 p-3 rounded-xl">
                        <div class="h-6 w-6 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-bold text-amber-700">1</span>
                        </div>
                        <p class="text-sm text-amber-900 leading-relaxed">
                            Gunakan menu <span class="font-semibold">Data Pegawai</span> untuk mengimpor daftar pegawai via Excel
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3 bg-white/70 p-3 rounded-xl">
                        <div class="h-6 w-6 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-bold text-amber-700">2</span>
                        </div>
                        <p class="text-sm text-amber-900 leading-relaxed">
                            Menu <span class="font-semibold">Upload Slip Gaji</span> untuk distribusi slip bulanan ke pegawai
                        </p>
                    </div>
                    
                    <div class="flex items-start gap-3 bg-white/70 p-3 rounded-xl">
                        <div class="h-6 w-6 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-bold text-amber-700">3</span>
                        </div>
                        <p class="text-sm text-amber-900 leading-relaxed">
                            Pastikan <span class="font-semibold">NIP pegawai</span> sudah benar sebelum upload slip gaji
                        </p>
                    </div>
                </div>
                
                
            </div>

        </div>

        

    </div>
</x-app-layout>