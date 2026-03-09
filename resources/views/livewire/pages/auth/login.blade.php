<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <div class="w-full max-w-6xl relative z-10">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                
                <div class="hidden lg:block space-y-8">
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-4 bg-white/80 backdrop-blur-sm px-6 py-4 rounded-2xl shadow-lg border border-white">
                            <div class="h-16 w-16 bg-white rounded-2xl flex items-center justify-center shadow-md border border-slate-100 p-2">
                                
                                <img src="{{ asset('img/logo.png') }}" alt="Logo Kemenkumham" class="w-full h-full object-contain">
                                
                            </div>
                            <div>
                                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">E-Payroll</h1>
                                <p class="text-sm text-slate-600 font-semibold">Kemenkumham Bali</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h2 class="text-[42px] font-extrabold text-slate-900 leading-[1.1] tracking-tight">
                                Sistem Pengelolaan<br/>
                                <span class="text-blue-600">Slip Gaji Digital</span>
                            </h2>
                            <p class="text-base text-slate-600 leading-relaxed font-medium">
                                Platform modern untuk distribusi dan manajemen slip gaji pegawai secara digital, aman, dan efisien.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 shadow-lg border border-white">
                            <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <p class="text-3xl font-bold text-slate-900 tracking-tight">500+</p>
                            <p class="text-xs text-slate-600 font-semibold mt-1.5 tracking-wide">Pegawai Aktif</p>
                        </div>
                        
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 shadow-lg border border-white">
                            <div class="h-10 w-10 bg-emerald-100 rounded-xl flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-3xl font-bold text-slate-900 tracking-tight">100%</p>
                            <p class="text-xs text-slate-600 font-semibold mt-1.5 tracking-wide">Akurasi Data</p>
                        </div>
                        
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 shadow-lg border border-white">
                            <div class="h-10 w-10 bg-violet-100 rounded-xl flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <p class="text-3xl font-bold text-slate-900 tracking-tight">24/7</p>
                            <p class="text-xs text-slate-600 font-semibold mt-1.5 tracking-wide">Sistem Aman</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 text-slate-600">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                        <span class="text-sm font-semibold">Dilindungi dengan enkripsi end-to-end</span>
                    </div>
                </div>

                <div class="w-full">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-slate-200">
                        <div class="lg:hidden mb-8 text-center">
                            <div class="inline-flex items-center gap-3 bg-slate-50 px-5 py-3 rounded-2xl">
                                <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-slate-200 p-1.5">
                                    
                                    <img src="{{ asset('img/logo.png') }}" alt="Logo Kemenkumham" class="w-full h-full object-contain">
                                    
                                </div>
                                <div class="text-left">
                                    <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">E-Payroll</h1>
                                    <p class="text-xs text-slate-600 font-semibold">Kemenkumham Bali</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-[28px] font-extrabold text-slate-900 tracking-tight text-center">Masuk ke Sistem</h3>
                            <p class="text-slate-600 mt-2 font-medium text-center">Selamat datang! Silakan login untuk melanjutkan</p>
                        </div>

                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form wire:submit="login" class="space-y-5">
                            <div>
                                <label for="email" class="block text-base font-bold text-slate-900 mb-2.5 tracking-tight">
                                    NIP / Email 
                                </label>
                                <div class="relative">
                                    <input 
                                        wire:model="form.email" 
                                        id="email" 
                                        type="text" 
                                        name="email" 
                                        required 
                                        autofocus 
                                        autocomplete="username"
                                        class="block w-full px-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        placeholder="Masukkan NIP atau Email" />
                                </div>
                                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                            </div>

                            <div>
                                <label for="password" class="block text-base font-bold text-slate-900 mb-2.5 tracking-tight">
                                    Password
                                </label>
                                <div class="relative">
                                    <input 
                                        wire:model="form.password" 
                                        id="password" 
                                        type="password"
                                        name="password"
                                        required 
                                        autocomplete="current-password"
                                        class="block w-full px-4 py-3.5 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 placeholder:font-normal focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        placeholder="Masukkan password" />

                                    <button type="button" id="togglePassword" aria-label="Tampilkan password" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.06 10.06 0 012.223-3.387M6.22 6.22A9.969 9.969 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.276 5.045M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <label for="remember" class="flex items-center cursor-pointer group">
                                    <input 
                                        wire:model="form.remember" 
                                        id="remember" 
                                        type="checkbox" 
                                        class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500 transition-all" 
                                        name="remember">
                                    <span class="ml-2.5 text-sm font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Ingat saya</span>
                                </label>
                                
                                @if (Route::has('password.request'))
                                    <a 
                                        href="{{ route('password.request') }}" 
                                        wire:navigate
                                        class="text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <button 
                                type="submit"
                                class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl text-[15px] font-bold hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-500/50 transition-all shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2.5 tracking-wide">
                                <span>Masuk</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </form>

                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-200"></div>
                            </div>
                            <div class="relative flex justify-center text-xs uppercase">
                                <span class="bg-white px-4 text-slate-500 font-bold tracking-wider">Atau</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-slate-600 font-medium">
                                Butuh bantuan? 
                                <a href="#" class="font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                    Hubungi Admin
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-xs text-slate-500 font-semibold">
                            © 2026 Kementerian Hukum RI - Kantor Wilayah Bali
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    @keyframes blob {
        0%, 100% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const pwd = document.getElementById('password');
        const toggle = document.getElementById('togglePassword');
        const eye = document.getElementById('eyeIcon');
        const eyeOff = document.getElementById('eyeOffIcon');
        if(!pwd || !toggle) return;
        toggle.addEventListener('click', function(){
            const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
            pwd.setAttribute('type', type);
            if(type === 'text'){
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
                toggle.setAttribute('aria-label','Sembunyikan password');
            } else {
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
                toggle.setAttribute('aria-label','Tampilkan password');
            }
        });
    });
    </script>
</div>