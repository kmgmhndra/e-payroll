<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 bg-white border-b border-slate-200 z-30 md:ml-72 shadow-sm">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Mobile Logo -->
            <div class="flex items-center">
                <div class="md:hidden">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        
                        <div class="h-10 w-10 bg-white rounded-xl flex items-center justify-center shadow-sm border border-slate-200 p-1">
                            
                            <img src="{{ asset('img/logo.png') }}" alt="Logo Kemenkumham" class="w-full h-full object-contain">
                            
                        </div>
                        
                        <div>
                            <span class="text-base font-bold text-slate-900">E-Payroll</span>
                            <p class="text-xs text-slate-500 leading-none">Kemenkumham Bali</p>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Breadcrumb/Page Title -->
                <div class="hidden md:flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="text-slate-600 font-medium">
                        @if(request()->routeIs('dashboard'))
                            Dashboard
                        @elseif(request()->routeIs('admin.users'))
                            Data Pegawai
                        @elseif(request()->routeIs('admin.import'))
                            Upload Slip Gaji
                        @else
                            E-Payroll System
                        @endif
                    </span>
                </div>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center gap-2">
                
                

                <!-- Divider -->
                <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

                <!-- User Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="64" contentClasses="bg-white shadow-xl border border-slate-200 rounded-2xl overflow-hidden">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-slate-50 focus:outline-none transition-all group">
                                <div class="relative">
                                    <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm shadow-sm group-hover:shadow-md transition-all">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                    <div class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 bg-emerald-500 rounded-full border-2 border-white"></div>
                                </div>
                                <div class="text-left hidden lg:block">
                                    <p class="text-xs font-semibold text-slate-900 leading-tight">{{ Str::limit(auth()->user()->name, 15) }}</p>
                                    <p class="text-xs text-slate-500">{{ auth()->user()->getRoleNames()[0] ?? 'User' }}</p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- User Info Header -->
                            <div class="px-5 py-4 bg-gradient-to-br from-slate-50 to-slate-100 border-b border-slate-200">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-slate-600 truncate">{{ auth()->user()->email }}</p>
                                        <span class="inline-flex items-center mt-1.5 px-2.5 py-0.5 bg-blue-100 text-blue-700 rounded-md text-xs font-bold">
                                            {{ auth()->user()->getRoleNames()[0] ?? 'User' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Menu Items -->
                            <div class="py-2 bg-white">
                                <x-dropdown-link :href="route('profile')" wire:navigate class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:bg-blue-100 hover:text-blue-800 transition-colors mx-2 rounded-lg">
                                    <div class="h-9 w-9 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-slate-900">Profil Saya</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Kelola informasi akun</p>
                                    </div>
                                </x-dropdown-link>

                                
                            </div>

                            <div class="border-t border-slate-200 bg-white"></div>

                            <!-- Logout -->
                            <div class="py-2 bg-white">
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link class="flex items-center gap-3 px-4 py-2.5 text-red-600 hover:bg-red-100 transition-colors mx-2 rounded-lg">
                                        <div class="h-9 w-9 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-red-600">Keluar</p>
                                            <p class="text-xs text-red-500 mt-0.5">Akhiri sesi Anda</p>
                                        </div>
                                    </x-dropdown-link>
                                </button>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-700 hover:text-slate-900 hover:bg-slate-100 focus:outline-none transition-all">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" stroke-width="2">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200 bg-white">
        <div class="px-4 pt-3 pb-3 space-y-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-3 rounded-xl">
                <div class="h-9 w-9 rounded-lg bg-slate-100 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="font-medium">{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            
            @role('admin')
            <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="flex items-center gap-3 rounded-xl">
                <div class="h-9 w-9 rounded-lg bg-slate-100 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <span class="font-medium">{{ __('Data Pegawai') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.import')" :active="request()->routeIs('admin.import')" class="flex items-center gap-3 rounded-xl">
                <div class="h-9 w-9 rounded-lg bg-slate-100 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="font-medium">{{ __('Upload Gaji') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.arsip')" :active="request()->routeIs('admin.arsip')" class="flex items-center gap-3 rounded-xl">
                <div class="h-9 w-9 rounded-lg bg-slate-100 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <span class="font-medium">{{ __('Arsip Payroll') }}</span>
            </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Mobile User Profile -->
        <div class="pt-4 pb-4 border-t border-slate-200 bg-slate-50">
            <div class="px-4">
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <div class="relative">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold shadow-md">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 h-3 w-3 bg-emerald-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-slate-900 truncate text-sm" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"></div>
                        <div class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</div>
                        <span class="inline-flex items-center mt-1 px-2 py-0.5 bg-blue-100 text-blue-700 rounded-md text-xs font-bold">
                            {{ auth()->user()->getRoleNames()[0] ?? 'User' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-3 px-4 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="flex items-center gap-3 rounded-xl bg-white">
                    <div class="h-9 w-9 rounded-lg bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="font-medium">{{ __('Profil Saya') }}</span>
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="flex items-center gap-3 text-red-600 hover:bg-red-50 rounded-xl bg-white">
                        <div class="h-9 w-9 rounded-lg bg-red-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <span class="font-medium">{{ __('Keluar') }}</span>
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>