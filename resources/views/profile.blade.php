<x-app-layout>

    <div class="max-w-5xl mx-auto space-y-8">
        
        <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
            <div class="flex items-center gap-6">
                <div class="h-20 w-20 bg-slate-900 rounded-2xl flex items-center justify-center text-3xl font-bold text-white">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ Auth::user()->name }}</h2>
                    <p class="text-slate-500 text-base font-medium">NIP {{ Auth::user()->nip }}</p>
                    <span class="mt-2 inline-block px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[11px] font-bold uppercase tracking-wider">
                        {{ Auth::user()->getRoleNames()[0] ?? 'Pegawai' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            <div class="md:col-span-4 space-y-6">
                <div class="space-y-1">
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-tight">Informasi Akun</h4>
                    <p class="text-xs leading-relaxed text-slate-500">Perbarui data profil dan alamat email Anda untuk memastikan notifikasi sistem terkirim dengan benar.</p>
                </div>

                <div class="p-5 bg-blue-50 rounded-xl border border-blue-100">
                    <h5 class="text-xs font-bold text-blue-800 uppercase mb-1">Pusat Bantuan</h5>
                    <p class="text-[11px] text-blue-700 leading-normal">
                        Jika terdapat kesalahan pada NIP, silakan hubungi operator BMN Kemenkumham Bali untuk sinkronisasi data ulang.
                    </p>
                </div>
            </div>

            <div class="md:col-span-8 space-y-8">
                
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="max-w-xl">
                        <livewire:profile.update-profile-information-form />
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-slate-900">Keamanan & Password</h4>
                        <p class="text-sm text-slate-500">Pastikan Anda menggunakan kombinasi karakter yang kuat.</p>
                    </div>
                    <div class="max-w-xl">
                        <livewire:profile.update-password-form />
                    </div>
                </div>

                <!-- <div class="bg-red-50 p-8 rounded-2xl border border-red-100 shadow-sm">
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-red-900">Hapus Akun</h4>
                        <p class="text-sm text-red-700 opacity-80">Tindakan ini permanen dan data Anda tidak dapat dipulihkan.</p>
                    </div>
                    <div class="max-w-xl">
                        <livewire:profile.delete-user-form />
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</x-app-layout>