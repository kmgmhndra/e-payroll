<x-app-layout>

    <div class="max-w-7xl mx-auto space-y-6 md:space-y-8">
        
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-3xl p-6 md:p-8 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -right-20 -top-20 w-60 h-60 md:w-80 md:h-80 bg-white rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-60 h-60 md:w-80 md:h-80 bg-white rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 md:h-14 md:w-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30 shrink-0">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold">Arsip Penggajian</h1>
                        <p class="text-slate-300 mt-1 text-xs md:text-sm">Riwayat slip gaji yang telah didistribusikan</p>
                    </div>
                </div>
                
                <div class="flex flex-col gap-3">
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/30 w-fit">
                        <div class="flex items-center gap-2">
                            <div class="h-2 w-2 bg-emerald-400 rounded-full animate-pulse"></div>
                            <span class="text-xs md:text-sm font-semibold text-white">Sistem Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @forelse($reports as $year => $months)
            <div class="space-y-4">
                
                <div class="sticky top-16 z-20 md:static flex items-center gap-4 bg-gray-50/95 md:bg-transparent backdrop-blur-md md:backdrop-blur-none py-2 md:py-0 -mx-4 px-4 md:mx-0 md:px-0 transition-all">
                    <div class="inline-flex items-center gap-3 px-4 py-2 md:px-5 md:py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg shadow-blue-500/30">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-base md:text-lg font-bold text-white">Tahun {{ $year }}</span>
                        <span class="px-2 py-0.5 bg-white/20 rounded-md text-[10px] md:text-xs font-semibold text-white">
                            {{ count($months) }} Periode
                        </span>
                    </div>
                    <div class="h-px flex-1 bg-slate-200"></div>
                </div>

                <div class="hidden md:block bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Periode</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Total Pegawai</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal Upload</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Ukuran File</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach($months as $data)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-600 transition-colors">
                                                <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-slate-900">{{ $data->month }} {{ $year }}</div>
                                                <div class="text-xs text-slate-500">Periode Gaji</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="h-8 w-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-semibold text-slate-900">{{ $data->total_pegawai }} Pegawai</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2 text-sm text-slate-600">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="font-medium">
                                                {{ \Carbon\Carbon::parse($data->tgl_upload)->setTimezone('Asia/Makassar')->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="text-xs text-slate-500 mt-0.5 ml-6">
                                            {{ \Carbon\Carbon::parse($data->tgl_upload)->setTimezone('Asia/Makassar')->format('H:i') }} WITA
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-semibold">
                                            <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div> Complete
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-slate-700">± {{ number_format($data->total_pegawai * 0.15, 2) }} MB</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.salary.download_zip', ['year' => $year, 'month' => $data->month]) }}" class="inline-flex items-center justify-center h-9 w-9 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all" title="Download ZIP">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.salary.period', ['year' => $year, 'month' => $data->month]) }}" class="inline-flex items-center justify-center h-9 w-9 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            
                                            <button type="button" onclick="deleteArchive('{{ $year }}', '{{ $data->month }}')" class="inline-flex items-center justify-center h-9 w-9 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus Arsip">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="md:hidden space-y-4">
                    @foreach($months as $data)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 relative overflow-hidden">
                        
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 font-bold text-xs shrink-0">
                                    {{ substr($data->month, 0, 3) }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $data->month }} {{ $year }}</h3>
                                    <span class="inline-flex items-center gap-1 text-[10px] px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-bold">
                                        <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div> Complete
                                    </span>
                                </div>
                            </div>
                            
                            <button type="button" onclick="deleteArchive('{{ $year }}', '{{ $data->month }}')" class="p-2 -mr-2 text-slate-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mb-5 text-sm">
                            <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                <span class="text-[10px] text-slate-500 block mb-1 uppercase tracking-wider font-bold">Total Pegawai</span>
                                <span class="font-bold text-slate-800 flex items-center gap-1.5 text-base">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                                    {{ $data->total_pegawai }}
                                </span>
                            </div>
                            <div class="bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                <span class="text-[10px] text-slate-500 block mb-1 uppercase tracking-wider font-bold">Estimasi File</span>
                                <span class="font-bold text-slate-800 flex items-center gap-1.5 text-base">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    ± {{ number_format($data->total_pegawai * 0.15, 2) }} MB
                                </span>
                            </div>
                            <div class="col-span-2 flex items-center gap-2 text-xs text-slate-500 bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Diupload: <span class="font-medium text-slate-700">{{ \Carbon\Carbon::parse($data->tgl_upload)->setTimezone('Asia/Makassar')->translatedFormat('d M Y, H:i') }} WITA</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.salary.download_zip', ['year' => $year, 'month' => $data->month]) }}" class="flex flex-col items-center justify-center py-2.5 px-4 bg-white border border-slate-300 text-slate-700 rounded-xl hover:bg-slate-50 transition-all text-center">
                                <svg class="w-5 h-5 mb-1 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                <span class="text-xs font-bold">ZIP File</span>
                            </a>

                            <a href="{{ route('admin.salary.period', ['year' => $year, 'month' => $data->month]) }}" class="flex flex-col items-center justify-center py-2.5 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all text-center">
                                <svg class="w-5 h-5 mb-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <span class="text-xs font-bold">Lihat Data</span>
                            </a>
                        </div>

                    </div>
                    @endforeach
                </div>

            </div>
        @empty
            <div class="bg-white rounded-3xl border border-slate-200 p-16 text-center shadow-sm">
                <div class="max-w-md mx-auto space-y-6">
                    <div class="inline-flex items-center justify-center">
                        <div class="h-24 w-24 bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-xl font-bold text-slate-900">Belum Ada Arsip</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">Belum ada data penggajian yang tersimpan.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <script>
        function deleteArchive(year, month) {
            Swal.fire({
                title: 'Hapus Arsip Gaji?',
                text: `Semua data gaji periode ${month} ${year} akan dihapus secara permanen. Anda yakin?`,
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
                    fetch(`/admin/salary/archive/${year}/${month}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Terjadi kesalahan pada sistem.', 'error');
                    });
                }
            });
        }
    </script>
</x-app-layout>