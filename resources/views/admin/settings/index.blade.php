<x-app-layout>

    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Page Header -->
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-white rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Pengaturan Pejabat</h1>
                        <p class="text-slate-300 mt-1 text-sm">Konfigurasi data penandatangan slip gaji</p>
                    </div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/30">
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-2 bg-emerald-400 rounded-full animate-pulse"></div>
                        <span class="text-sm font-semibold">Aktif</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- ==================== FORM KEPALA BAGIAN UMUM ==================== --}}
                <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-violet-50 to-violet-100 px-8 py-6 border-b border-violet-200">
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 bg-violet-600 rounded-xl flex items-center justify-center shadow-lg shadow-violet-500/30">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-violet-900">Kepala Bagian Umum</h3>
                                <p class="text-sm text-violet-700 font-medium">Penandatangan kiri pada slip gaji</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="kabag_umum_nama" class="block text-sm font-bold text-slate-900 mb-2.5">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="kabag_umum_nama" 
                                    name="kabag_umum_nama" 
                                    value="{{ $settings['kabag_umum_nama'] ?? '' }}" 
                                    class="block w-full pl-12 pr-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition-all"
                                    placeholder="Contoh: I Nengah Sukadana"
                                    required>
                            </div>
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="kabag_umum_nip" class="block text-sm font-bold text-slate-900 mb-2.5">
                                Nomor Induk Pegawai (NIP)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="kabag_umum_nip" 
                                    name="kabag_umum_nip" 
                                    value="{{ $settings['kabag_umum_nip'] ?? '' }}" 
                                    class="block w-full pl-12 pr-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium font-mono text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition-all"
                                    placeholder="Contoh: 197703042001121002"
                                    required>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="kabag_umum_jabatan" class="block text-sm font-bold text-slate-900 mb-2.5">
                                Jabatan
                            </label>
                            <input 
                                type="text" 
                                id="kabag_umum_jabatan" 
                                name="kabag_umum_jabatan" 
                                value="{{ $settings['kabag_umum_jabatan'] ?? 'Kepala Bagian Umum' }}" 
                                class="block w-full px-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition-all"
                                placeholder="Contoh: Kepala Bagian Umum"
                                required>
                        </div>
                    </div>
                </div>

                {{-- ==================== FORM BENDAHARA ==================== --}}
                <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-8 py-6 border-b border-blue-200">
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-blue-900">Bendahara Gaji / PPABP</h3>
                                <p class="text-sm text-blue-700 font-medium">Penandatangan kanan pada slip gaji</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="bendahara_nama" class="block text-sm font-bold text-slate-900 mb-2.5">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="bendahara_nama" 
                                    name="bendahara_nama" 
                                    value="{{ $settings['bendahara_nama'] ?? '' }}" 
                                    class="block w-full pl-12 pr-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="Contoh: I Wayan Oka Putra Suartama"
                                    required>
                            </div>
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="bendahara_nip" class="block text-sm font-bold text-slate-900 mb-2.5">
                                Nomor Induk Pegawai (NIP)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="bendahara_nip" 
                                    name="bendahara_nip" 
                                    value="{{ $settings['bendahara_nip'] ?? '' }}" 
                                    class="block w-full pl-12 pr-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium font-mono text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="Contoh: 198801212012121002"
                                    required>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="bendahara_jabatan" class="block text-sm font-bold text-slate-900 mb-2.5">
                                Jabatan
                            </label>
                            <input 
                                type="text" 
                                id="bendahara_jabatan" 
                                name="bendahara_jabatan" 
                                value="{{ $settings['bendahara_jabatan'] ?? 'Bend. Gaji/PPABP' }}" 
                                class="block w-full px-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Contoh: Bend. Gaji/PPABP"
                                required>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ==================== TOMBOL SIMPAN ==================== --}}
            <div class="mt-6">
                <button 
                    type="submit" 
                    class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl text-[15px] font-bold hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-500/50 transition-all shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2.5 tracking-wide">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Simpan Semua Perubahan</span>
                </button>
            </div>

        </form>

        {{-- ==================== PREVIEW ==================== --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 px-8 py-6 border-b border-emerald-200">
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-emerald-900">Preview Tanda Tangan</h3>
                        <p class="text-sm text-emerald-700 font-medium">Pratinjau tampilan di slip gaji PDF</p>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <div class="bg-gradient-to-br from-slate-50 to-slate-100 border-2 border-dashed border-slate-300 rounded-2xl p-8">
                    <div class="bg-white border border-slate-200 shadow-xl rounded-xl p-8 max-w-2xl mx-auto">
                        <div class="flex justify-between text-sm" style="font-family: 'Times New Roman', serif;">
                            {{-- Kiri: Kabag Umum --}}
                            <div class="text-center space-y-1">
                                <p>An. Kepala Kantor Wilayah</p>
                                <p>Kementerian Hukum dan HAM Bali</p>
                                <p>{{ $settings['kabag_umum_jabatan'] ?? 'Kepala Bagian Umum' }}</p>
                                <div class="py-6"></div>
                                <p class="font-bold" style="text-decoration: underline;">
                                    {{ strtoupper($settings['kabag_umum_nama'] ?? 'Nama Belum Diisi') }}
                                </p>
                                <p>NIP {{ $settings['kabag_umum_nip'] ?? '-' }}</p>
                            </div>

                            {{-- Kanan: Bendahara --}}
                            <div class="text-center space-y-1">
                                <p>Denpasar, {{ now()->locale('id')->isoFormat('D MMMM Y') }}</p>
                                <p>{{ $settings['bendahara_jabatan'] ?? 'Bend. Gaji/PPABP' }}</p>
                                <div class="py-8"></div>
                                <p class="font-bold" style="text-decoration: underline;">
                                    {{ strtoupper($settings['bendahara_nama'] ?? 'Nama Belum Diisi') }}
                                </p>
                                <p>NIP {{ $settings['bendahara_nip'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-slate-200 shadow-sm">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-slate-600 font-medium">
                                Ilustrasi tampilan — Posisi aktual menyesuaikan layout PDF
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1000
            });
        });
    </script>
    @endif
</x-app-layout>