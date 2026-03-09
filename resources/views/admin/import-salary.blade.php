<x-app-layout>
    <div x-data="{ 
            isUploading: false, 
            progress: 0,
            submitForm(event) {
                // 1. Aktifkan Loading
                this.isUploading = true;
                this.progress = 0;

                // 2. Simulasi Progress Bar (Jalan sampai 90%)
                const interval = setInterval(() => {
                    if (this.progress < 90) {
                        this.progress += Math.floor(Math.random() * 5) + 1;
                    } else {
                        clearInterval(interval);
                    }
                }, 200);

                // 3. Submit Form secara Manual
                // Kita biarkan browser reload halaman (standard post)
                // Loading akan tetap tampil sampai halaman selesai reload
                event.target.submit(); 
            }
         }" 
         class="relative">

        <div x-show="isUploading" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 backdrop-blur-none"
             x-transition:enter-end="opacity-100 backdrop-blur-sm"
             class="fixed inset-0 z-[99] flex items-center justify-center bg-white/80 backdrop-blur-sm"
             style="display: none;"> <div class="bg-white p-8 rounded-3xl shadow-2xl border border-slate-100 max-w-sm w-full text-center relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-indigo-50 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <div class="relative w-24 h-24 mx-auto mb-6">
                        <div class="absolute inset-0 border-4 border-slate-100 rounded-full"></div>
                        <div class="absolute inset-0 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-10 h-10 text-blue-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 mb-2">Mengupload Data...</h3>
                    <p class="text-sm text-slate-500 mb-6">Mohon tunggu, sistem sedang memproses slip gaji pegawai.</p>

                    <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden shadow-inner relative">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-300 relative" 
                             :style="`width: ${progress}%`">
                             <div class="absolute inset-0 bg-white/30 w-full -translate-x-full animate-[shimmer_1.5s_infinite]"></div>
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-blue-600 mt-2" x-text="progress + '%'"></p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto space-y-6">
            
            <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute -right-20 -top-20 w-80 h-80 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white rounded-full blur-3xl"></div>
                </div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="h-14 w-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">Upload Slip Gaji Bulanan</h1>
                            <p class="text-blue-100 mt-1">Distribusikan slip gaji ke seluruh pegawai</p>
                        </div>
                    </div>
                    
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/30">
                        <p class="text-xs text-blue-100 font-medium">Periode Upload</p>
                        <p class="text-lg font-bold text-white">{{ now()->format('F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase">Format File</p>
                            <p class="text-lg font-bold text-slate-900 mt-1">.XLSX / .XLS</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="h-10 w-10 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase">Ukuran Maks</p>
                            <p class="text-lg font-bold text-slate-900 mt-1">10 MB</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="h-10 w-10 bg-violet-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase">Total Pegawai</p>
                            <p class="text-lg font-bold text-slate-900 mt-1">
                                {{ $total_pegawai ?? 0 }} Orang
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200 p-6 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="h-10 w-10 bg-amber-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-amber-500/30">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-amber-900 mb-3">Petunjuk Upload Slip Gaji</h3>
                        <div class="space-y-2">
                            <div class="flex items-start gap-2">
                                <div class="h-6 w-6 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-amber-700">1</span>
                                </div>
                                <p class="text-sm text-amber-900 leading-relaxed">Pastikan <span class="font-semibold">NIP pegawai</span> di file Excel sudah sesuai dengan data di sistem</p>
                            </div>
                            <div class="flex items-start gap-2">
                                <div class="h-6 w-6 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-amber-700">2</span>
                                </div>
                                <p class="text-sm text-amber-900 leading-relaxed">Pilih <span class="font-semibold">periode bulan dan tahun</span> yang relevan dengan slip gaji</p>
                            </div>
                            <div class="flex items-start gap-2">
                                <div class="h-6 w-6 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-bold text-amber-700">3</span>
                                </div>
                                <p class="text-sm text-amber-900 leading-relaxed">Pastikan format file adalah <span class="font-semibold">.xlsx atau .xls</span> dengan ukuran maksimal 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-8 py-6 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-slate-900 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Form Upload Slip Gaji</h3>
                            <p class="text-sm text-slate-500">Lengkapi informasi periode dan upload file Excel</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.salary.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8" @submit.prevent="submitForm($event)">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Pilih Bulan
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="month" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-slate-50 hover:bg-white">
                                @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                                    <option value="{{ $bulan }}" {{ date('n') == $index + 1 ? 'selected' : '' }}>{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Pilih Tahun
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="year" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-slate-50 hover:bg-white">
                                @for($i = date('Y'); $i >= date('Y')-2; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            File Excel Slip Gaji
                            <span class="text-red-500">*</span>
                        </label>
                        
                        <div x-data="{ 
                            dragging: false, 
                            fileName: '',
                            fileSize: '',
                            handleFile(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    this.fileName = file.name;
                                    this.fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                                }
                            }
                        }">
                            <div class="relative border-2 border-dashed rounded-2xl p-10 text-center transition-all duration-300"
                                 :class="dragging ? 'border-blue-500 bg-blue-50' : fileName ? 'border-emerald-500 bg-emerald-50' : 'border-slate-300 bg-slate-50 hover:bg-white hover:border-slate-400'"
                                 @dragover.prevent="dragging = true"
                                 @dragleave.prevent="dragging = false"
                                 @drop.prevent="dragging = false; handleFile($event.dataTransfer)">
                                
                                <input 
                                    type="file" 
                                    name="file" 
                                    id="file" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                    accept=".xlsx,.xls"
                                    required
                                    @change="handleFile($event)">
                                
                                <div x-show="!fileName" class="space-y-4">
                                    <div class="inline-flex items-center justify-center">
                                        <div class="h-16 w-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg shadow-blue-500/30 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="text-base font-semibold text-slate-900">Klik atau tarik file ke sini</p>
                                        <p class="text-sm text-slate-500">Drag & drop file Excel Anda atau klik untuk memilih</p>
                                        <div class="flex items-center justify-center gap-2 mt-3">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-white rounded-lg text-xs font-semibold text-slate-600 border border-slate-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                .XLSX
                                            </span>
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-white rounded-lg text-xs font-semibold text-slate-600 border border-slate-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                .XLS
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div x-show="fileName" class="space-y-4">
                                    <div class="inline-flex items-center justify-center">
                                        <div class="h-16 w-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg shadow-emerald-500/30 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-base font-semibold text-emerald-900" x-text="fileName"></p>
                                        <p class="text-sm text-emerald-700" x-text="'Ukuran: ' + fileSize"></p>
                                        <button type="button" @click="fileName = ''; fileSize = ''; $el.closest('div').querySelector('input[type=file]').value = ''" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 mt-2">
                                            Ganti file
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Dashboard
                        </a>
                        
                        <button type="submit" 
                                :disabled="isUploading"
                                class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl text-sm font-bold hover:from-blue-700 hover:to-blue-800 transition-all shadow-lg shadow-blue-500/30 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Proses & Upload Sekarang
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 bg-slate-200 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900">Riwayat Upload Terakhir</h3>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden">
                    @if($salaryHistory->count() > 0)
                        <div class="divide-y divide-slate-200">
                            @foreach($salaryHistory as $history)
                                @php
                                    $totalUser = \App\Models\Salary::where('month', $history->month)
                                        ->where('year', $history->year)
                                        ->count();
                                    $lastUpload = \App\Models\Salary::where('month', $history->month)
                                        ->where('year', $history->year)
                                        ->latest()
                                        ->first();
                                @endphp
                                <div class="p-5 hover:bg-slate-50 transition-colors flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">{{ $history->month }} {{ $history->year }}</p>
                                            <div class="flex items-center gap-3 mt-1">
                                                <p class="text-xs text-slate-500 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                    </svg>
                                                    {{ $totalUser }} pegawai
                                                </p>
                                                @if($lastUpload)
                                                    <p class="text-xs text-slate-500 flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        {{ $lastUpload->created_at->setTimezone('Asia/Makassar')->format('d M Y H:i') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-lg border border-emerald-200">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            Berhasil
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 text-center">
                            <div class="h-16 w-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-600">Belum ada riwayat upload</p>
                            <p class="text-xs text-slate-400 mt-1">Mulai upload slip gaji untuk melihat riwayat di sini</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
</x-app-layout>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1000,
                didClose: () => {
                    // Refresh halaman untuk update data riwayat
                    // window.location.reload(); 
                }
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#3b82f6'
            });
        });
    </script>
@endif