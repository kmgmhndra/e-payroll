<x-app-layout>
    <div x-data="{ 
            modalTambah: false, 
            modalImport: false, 
            modalEdit: false, 
            searchQuery: '{{ addslashes(request('search')) }}',
            editingUser: null, 
            selectedFileName: '',
            
            // --- TAMBAHAN BARU (LOADING STATE) ---
            isImporting: false,
            importProgress: 0,
            resetImport() {
                this.isImporting = false;
                this.importProgress = 0;
                this.selectedFileName = '';
                this.modalImport = false;
            }
            // -------------------------------------
         }" 
         class="relative">
        
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- Page Title & Actions -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-slate-900">Data Pegawai</h1>
                            <p class="text-sm text-slate-500 mt-0.5">Kelola data personel Kemenkumham Bali</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 flex-wrap">
                    <button @click="modalImport = true" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Import Excel
                    </button>
                    <button @click="modalTambah = true" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl text-sm font-semibold text-white hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg shadow-blue-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Pegawai
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    
                <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 p-5 rounded-2xl border border-blue-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">Total Akun</p>
                            <p class="text-3xl font-bold text-blue-900">{{ $total_semua }}</p>
                        </div>
                        <div class="h-12 w-12 bg-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 p-5 rounded-2xl border border-emerald-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-1">Administrator</p>
                            <p class="text-3xl font-bold text-emerald-900">{{ $total_admin }}</p>
                        </div>
                        <div class="h-12 w-12 bg-emerald-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-violet-50 to-violet-100/50 p-5 rounded-2xl border border-violet-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-violet-600 uppercase tracking-wide mb-1">Pegawai</p>
                            <p class="text-3xl font-bold text-violet-900">{{ $total_pegawai }}</p>
                        </div>
                        <div class="h-12 w-12 bg-violet-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Search & Filter Section -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <form method="GET" action="{{ route('admin.users') }}">
                    
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                class="block w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder:text-slate-400" 
                                placeholder="Cari nama, NIP, atau email... (Tekan Enter)"
                                autocomplete="off">
                        </div>
                        
                        <div class="flex gap-2">
                            <select name="role" onchange="this.form.submit()" class="pl-3 pr-8 py-3 border border-slate-200 rounded-xl bg-slate-50 text-sm font-medium text-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <option value="Semua Role" {{ request('role') == 'Semua Role' ? 'selected' : '' }}>Semua Role</option>
                                <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Pegawai" {{ request('role') == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Pegawai
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    NIP
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($users as $user)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <div class="h-11 w-11 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div class="absolute -bottom-1 -right-1 h-4 w-4 bg-emerald-500 rounded-full border-2 border-white"></div>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900">{{ $user->name }}</div>
                                            <div class="text-xs text-slate-500 mt-0.5">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-mono font-medium text-slate-700">{{ $user->nip }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(($user->getRoleNames()[0] ?? 'Pegawai') === 'admin')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-lg border border-emerald-200">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-lg border border-blue-200">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                            </svg>
                                            Pegawai
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-lg">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button 
                                            @click="editingUser = {{ json_encode($user) }}; modalEdit = true" 
                                            class="inline-flex items-center justify-center h-9 w-9 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" 
                                            title="Edit Data">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button 
                                            @click="deleteUser({{ $user->id }})" 
                                            class="inline-flex items-center justify-center h-9 w-9 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" 
                                            title="Hapus Data">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="h-16 w-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-600">Data Tidak Ditemukan</p>
                                        <p class="text-xs text-slate-400 mt-1">Belum ada pegawai yang terdaftar dalam sistem</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Footer -->
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-slate-600">
                            Menampilkan <span class="font-semibold text-slate-900">{{ $users->firstItem() }}</span> 
                            sampai <span class="font-semibold text-slate-900">{{ $users->lastItem() }}</span> 
                            dari <span class="font-semibold text-slate-900">{{ $users->total() }}</span> pegawai
                        </p>
                        
                        <div class="flex gap-2">
                            @if ($users->onFirstPage())
                                <button disabled class="px-4 py-2 text-sm font-medium text-slate-400 bg-slate-100 border border-slate-200 rounded-lg cursor-not-allowed">
                                    Sebelumnya
                                </button>
                            @else
                                <a href="{{ $users->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                                    Sebelumnya
                                </a>
                            @endif

                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                                    Selanjutnya
                                </a>
                            @else
                                <button disabled class="px-4 py-2 text-sm font-medium text-slate-400 bg-slate-100 border border-slate-200 rounded-lg cursor-not-allowed">
                                    Selanjutnya
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Pegawai -->
        <div x-show="modalTambah" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
             x-cloak>
            
            <div @click.away="modalTambah = false" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden">
                
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-white">Tambah Pegawai Baru</h3>
                            <p class="text-sm text-blue-100 mt-1">Lengkapi formulir pendaftaran personel</p>
                        </div>
                        <button @click="modalTambah = false" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-3">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            required 
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Masukkan nama lengkap">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NIP <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nip" 
                                required 
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="18 digit">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                required 
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="email@example.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nomor Rekening
                        </label>
                        <input 
                            type="number" 
                            name="no_rekening" 
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Contoh: 1234567890">
                    </div>
                    
                    <!-- Info Box -->
                    <div class="flex items-start gap-3 p-4 bg-amber-50 rounded-xl border border-amber-200">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                        </svg>
                        <div>
                            <p class="text-xs font-semibold text-amber-900">Informasi Password</p>
                            <p class="text-xs text-amber-700 mt-0.5">Password akan otomatis diset menggunakan kombinasi nama dan NIP yang didaftarkan.</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-2">
                        <button 
                            type="button" 
                            @click="modalTambah = false" 
                            class="flex-1 px-6 py-3 text-sm font-semibold text-slate-700 bg-slate-100 rounded-xl hover:bg-slate-200 transition-all">
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 shadow-lg shadow-blue-500/30 transition-all">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Import Excel -->
        <div x-show="modalImport" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
             x-cloak>
            
            <div @click.away="!isImporting && resetImport()"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden relative">
                
                <div class="p-8">
                    
                    <div x-show="!isImporting" x-transition:enter="transition ease-out duration-300">
                        <div class="flex justify-center mb-6">
                            <div class="h-20 w-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">Import Data Pegawai</h3>
                            <p class="text-sm text-slate-500">Upload file Excel untuk menambahkan data secara massal</p>
                        </div>

                        <form @submit.prevent="submitImport($event)" class="space-y-6">
                            @csrf
                            
                            <div class="relative">
                                <input 
                                    type="file" 
                                    name="file" 
                                    class="hidden" 
                                    id="fileExcel" 
                                    accept=".xlsx,.xls"
                                    @change="selectedFileName = $event.target.files[0]?.name || ''">
                                <label for="fileExcel" class="block cursor-pointer">
                                    <div class="rounded-2xl p-10 text-center transition-all group"
                                         :class="selectedFileName ? 'border-2 border-green-400 bg-green-50' : 'border-2 border-dashed border-slate-300 bg-slate-50 hover:border-blue-400 hover:bg-blue-50/50'">
                                        <template x-if="!selectedFileName">
                                            <div>
                                                <svg class="w-12 h-12 text-slate-400 group-hover:text-blue-500 mx-auto mb-4 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                                <p class="text-sm font-semibold text-slate-700 mb-1">Klik untuk upload file</p>
                                                <p class="text-xs text-slate-500">Format: .xlsx atau .xls (Maks. 5MB)</p>
                                            </div>
                                        </template>
                                        <template x-if="selectedFileName">
                                            <div>
                                                <svg class="w-12 h-12 text-green-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                                </svg>
                                                <p class="text-sm font-semibold text-green-700 mb-1" x-text="'File Terpilih: ' + selectedFileName"></p>
                                                <p class="text-xs text-green-600">Klik untuk mengganti file</p>
                                            </div>
                                        </template>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="text-center">
                                <a href="{{ asset('templates/format_import_pegawai.xlsx') }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download Template Excel
                                </a>
                            </div>
                            
                            <div class="flex gap-3">
                                <button 
                                    type="button" 
                                    @click="modalImport = false" 
                                    class="flex-1 px-6 py-3 text-sm font-semibold text-slate-700 bg-slate-100 rounded-xl hover:bg-slate-200 transition-all">
                                    Batal
                                </button>
                                <button 
                                    type="submit"
                                    :disabled="!selectedFileName"
                                    :class="selectedFileName ? 'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 shadow-lg shadow-blue-500/30 cursor-pointer' : 'bg-slate-300 cursor-not-allowed opacity-60'"
                                    class="flex-1 px-6 py-3 text-white text-sm font-semibold rounded-xl transition-all">
                                    Mulai Import
                                </button>
                            </div>
                        </form>
                    </div>

                    <div x-show="isImporting" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="flex flex-col items-center justify-center py-6">
                        
                        <div class="relative mb-8">
                            <div class="h-24 w-24 rounded-full border-4 border-slate-100"></div>
                            
                            <div class="absolute top-0 left-0 h-24 w-24 rounded-full border-4 border-blue-600 border-t-transparent animate-spin"></div>
                            
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-slate-800 mb-2">Sedang Memproses Data...</h3>
                        <p class="text-sm text-slate-500 mb-8 text-center max-w-[250px]">
                            Mohon jangan tutup halaman ini. Sistem sedang membaca file Excel Anda.
                        </p>

                        <div class="w-full space-y-2">
                            <div class="flex justify-between text-xs font-semibold text-slate-600 px-1">
                                <span>Progress</span>
                                <span x-text="importProgress + '%'">0%</span>
                            </div>
                            <div class="h-3 w-full bg-slate-100 rounded-full overflow-hidden shadow-inner">
                                <div class="h-full bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600 transition-all duration-300 ease-out relative" 
                                     :style="`width: ${importProgress}%`">
                                     <div class="absolute top-0 left-0 bottom-0 right-0 bg-gradient-to-r from-transparent via-white/30 to-transparent w-full -translate-x-full animate-[shimmer_1.5s_infinite]"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>
            </div>
        </div>

        <!-- Modal Edit Pegawai -->
        <div x-show="modalEdit" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
             x-cloak>
            
            <div @click.away="modalEdit = false" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden">
                
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-white">Edit Data Pegawai</h3>
                            <p class="text-sm text-blue-100 mt-1">Perbarui informasi personel</p>
                        </div>
                        <button @click="modalEdit = false" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form @submit.prevent="submitEditForm(editingUser, $data)" class="p-6 space-y-3">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            x-model="editingUser.name"
                            required 
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Masukkan nama lengkap">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                NIP <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                x-model="editingUser.nip"
                                required 
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="18 digit">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                x-model="editingUser.email"
                                required 
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                                placeholder="email@example.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Nomor Rekening
                        </label>
                        <input 
                            type="number" 
                            x-model="editingUser.no_rekening" 
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Nomor Rekening Bank">
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-2">
                        <button 
                            type="button" 
                            @click="modalEdit = false" 
                            class="flex-1 px-6 py-3 text-sm font-semibold text-slate-700 bg-slate-100 rounded-xl hover:bg-slate-200 transition-all">
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 shadow-lg shadow-blue-500/30 transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- JavaScript -->

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        showConfirmButton: false, // Hilangkan tombol OK
                        timer: 1000 // Tutup otomatis 1.5 detik
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
        <script>
            // Fungsi Delete User (Tetap sama, tidak perlu diubah)
            function deleteUser(userId) {
                Swal.fire({
                    title: 'Hapus Pegawai?',
                    text: 'Data pegawai akan dihapus secara permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    willOpen: () => {
                        document.querySelector('.swal2-popup').style.zIndex = '9999';
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/users/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // --- BAGIAN INI DIUBAH (Tanpa Tombol OK) ---
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Pegawai berhasil dihapus',
                                    showConfirmButton: false, // Hilangkan tombol OK
                                    timer: 1000 // Tutup otomatis 1.5 detik
                                }).then(() => {
                                    location.reload();
                                });
                                // -------------------------------------------
                            } else {
                                Swal.fire('Gagal!', data.message, 'error');
                            }
                        });
                    }
                });
            }

            // FUNGSI PERBAIKAN: Menerima parameter 'user' langsung dari Form HTML
            // Tambahkan parameter kedua 'alpineScope'
            function submitEditForm(user, alpineScope) {
                if (!user || !user.id) {
                    Swal.fire('Error!', 'Data pegawai tidak valid.', 'error');
                    return;
                }

                const userId = user.id;
                const formData = {
                    name: user.name,
                    nip: user.nip,
                    email: user.email,
                    no_rekening: user.no_rekening
                };

                fetch(`/admin/users/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) return response.json().then(err => { throw err; });
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // --- LANGKAH KUNCI: TUTUP MODAL LEWAT SCOPE ---
                        // Ini akan memaksa modal tertutup detik itu juga
                        if (alpineScope) {
                            alpineScope.modalEdit = false; 
                        }
                        // ----------------------------------------------

                        // Beri jeda sangat singkat (50ms) biar mata user melihat modal hilang dulu
                        // baru SweetAlert muncul di atas tabel
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message || 'Data berhasil diperbarui',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        }, 50);

                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({ icon: 'error', title: 'Gagal!', text: error.message || 'Terjadi kesalahan sistem' });
                });
            }

            // --- COPY FUNCTION INI KE DALAM TAG <SCRIPT> ---
            function submitImport(event) {
                const element = event.target.closest('[x-data]');
                const alpineData = Alpine.$data(element);
                
                // Aktifkan Loading
                alpineData.isImporting = true;
                alpineData.importProgress = 0;

                const formData = new FormData(event.target);
                
                // Simulasi Progress Bar
                const progressInterval = setInterval(() => {
                    if (alpineData.importProgress < 90) {
                        alpineData.importProgress += Math.floor(Math.random() * 10) + 1;
                    }
                }, 300);

                // Kirim Data ke Controller
                fetch('{{ route("admin.users.import") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json' // ✅ PENTING: Minta JSON Response
                    },
                    body: formData
                })
                .then(response => {
                    // ✅ PERBAIKAN: Cek apakah response benar-benar JSON
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    clearInterval(progressInterval);
                    alpineData.importProgress = 100;
                    
                    setTimeout(() => {
                        alpineData.resetImport();
                        
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message || 'Data berhasil diimport',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => location.reload());
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    }, 500);
                })
                .catch(error => {
                    clearInterval(progressInterval);
                    alpineData.resetImport(); // ✅ Reset modal jika error
                    console.error('Import Error:', error);
                    
                    // ✅ Tampilkan pesan error yang lebih informatif
                    const errorMessage = error.message || 'Terjadi kesalahan sistem';
                    Swal.fire({
                        icon: 'error',
                        title: 'Import Gagal!',
                        text: errorMessage,
                        confirmButtonColor: '#3b82f6'
                    });
                });
            }
        </script>

        <style>
            @keyframes shimmer {
                100% { transform: translateX(100%); }
            }
        </style>

    </div>
</x-app-layout>