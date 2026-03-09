<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <style>
            /* Custom Scrollbar */
            .scrollbar-thin::-webkit-scrollbar {
                width: 6px;
            }
            .scrollbar-thin::-webkit-scrollbar-track {
                background: transparent;
            }
            .scrollbar-thin::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }
            .scrollbar-thin::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>

        <style>
            /* Tablet portrait: hide sidebar by default */
            @media (min-width: 768px) and (orientation: portrait) {
                aside.fixed.left-0.top-0.h-screen.w-72.hidden.md\:flex {
                    display: none !important;
                }
                
                /* Show sidebar only when body has show-sidebar class */
                body.show-sidebar aside.fixed.left-0.top-0.h-screen.w-72.hidden.md\:flex {
                    display: flex !important;
                    z-index: 50;
                }
                
                /* Overlay when sidebar is open */
                body.show-sidebar::before {
                    content: '';
                    position: fixed;
                    inset: 0;
                    background: rgba(0, 0, 0, 0.45);
                    z-index: 40;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="flex min-h-screen">
            
            <!-- Sidebar -->
            <aside class="fixed left-0 top-0 h-screen w-72 bg-white hidden md:flex flex-col flex-shrink-0 border-r border-slate-200 shadow-sm z-40">
                
                <!-- Logo & Brand -->
                <div class="p-6 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-200 p-2">
                                
                                <img src="{{ asset('favicon.ico') }}" alt="Logo E-Payroll" class="w-full h-full object-contain">
                                
                            </div>
                            <div class="absolute -bottom-1 -right-1 h-4 w-4 bg-emerald-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-900">E-Payroll</h1>
                            <p class="text-xs text-slate-500 font-medium">Kemenkum Bali</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent">
                    
                    <!-- Main Menu -->
                    <div class="space-y-1">
                        <div class="px-3 mb-3">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Menu Utama</p>
                        </div>
                        
                        <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <div class="h-10 w-10 rounded-xl flex items-center justify-center {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-slate-100 group-hover:bg-slate-200' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold">Dashboard</p>
                                <p class="text-xs {{ request()->routeIs('dashboard') ? 'text-blue-100' : 'text-slate-400' }}">Ringkasan sistem</p>
                            </div>
                            @if(request()->routeIs('dashboard'))
                                <div class="h-2 w-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                    </div>

                    @role('admin')
                    <!-- Admin Menu -->
                    <div class="space-y-1">
                        <div class="px-3 mb-3 flex items-center gap-2">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Administrator</p>
                            <div class="h-px flex-1 bg-slate-200"></div>
                        </div>
                        
                        <a href="{{ route('admin.users') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <div class="h-10 w-10 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.users') ? 'bg-white/20' : 'bg-slate-100 group-hover:bg-slate-200' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold">Data Pegawai</p>
                                <p class="text-xs {{ request()->routeIs('admin.users') ? 'text-blue-100' : 'text-slate-400' }}">Kelola personel</p>
                            </div>
                            @if(request()->routeIs('admin.users'))
                                <div class="h-2 w-2 bg-white rounded-full"></div>
                            @endif
                        </a>

                        <a href="{{ route('admin.import') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.import') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <div class="h-10 w-10 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.import') ? 'bg-white/20' : 'bg-slate-100 group-hover:bg-slate-200' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold">Upload Slip Gaji</p>
                                <p class="text-xs {{ request()->routeIs('admin.import') ? 'text-blue-100' : 'text-slate-400' }}">Distribusi bulanan</p>
                            </div>
                            @if(request()->routeIs('admin.import'))
                                <div class="h-2 w-2 bg-white rounded-full"></div>
                            @endif
                        </a>

                        <!-- Additional Admin Menu Items -->
                        <a href="{{ route('admin.arsip') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.arsip') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <div class="h-10 w-10 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.arsip') ? 'bg-white/20' : 'bg-slate-100 group-hover:bg-slate-200' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold">Arsip Payroll</p>
                                <p class="text-xs {{ request()->routeIs('admin.arsip') ? 'text-blue-100' : 'text-slate-400' }}">Riwayat Input</p>
                            </div>
                            @if(request()->routeIs('admin.arsip'))
                                <div class="h-2 w-2 bg-white rounded-full"></div>
                            @endif
                        </a>

                        <a href="{{ route('admin.settings.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.settings.index') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <div class="h-10 w-10 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.settings.index') ? 'bg-white/20' : 'bg-slate-100 group-hover:bg-slate-200' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold">Tanda Tangan</p>
                                <p class="text-xs {{ request()->routeIs('admin.settings.index') ? 'text-blue-100' : 'text-slate-400' }}">Setting Bendahara</p>
                            </div>
                            @if(request()->routeIs('admin.settings.index'))
                                <div class="h-2 w-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                    </div>
                    @endrole

                    @role('pegawai')
                    <!-- Employee Menu -->
                    <!-- <div class="space-y-1">
                        <div class="px-3 mb-3 flex items-center gap-2">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Menu Pegawai</p>
                            <div class="h-px flex-1 bg-slate-200"></div>
                        </div>
                        
                        <a href="{{ route('user.slips') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('user.slips') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-500/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <div class="h-10 w-10 rounded-xl flex items-center justify-center {{ request()->routeIs('user.slips') ? 'bg-white/20' : 'bg-slate-100 group-hover:bg-slate-200' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold">Slip Gaji Saya</p>
                                <p class="text-xs {{ request()->routeIs('user.slips') ? 'text-blue-100' : 'text-slate-400' }}">Riwayat pembayaran</p>
                            </div>
                            @if(request()->routeIs('user.slips'))
                                <div class="h-2 w-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                    </div> -->
                    @endrole

                </nav>

                <!-- User Profile Card -->
                <div class="p-4 border-t border-slate-200">
                    <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-colors">
                        <div class="relative">
                            <div class="h-11 w-11 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 h-4 w-4 bg-emerald-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-700 rounded-md text-xs font-semibold">
                                    {{ Auth::user()->getRoleNames()[0] ?? 'User' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- System Info -->
                    <div class="mt-3 p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                        <div class="flex items-center gap-2">
                            <div class="h-2 w-2 bg-emerald-500 rounded-full animate-pulse"></div>
                            <p class="text-xs font-semibold text-emerald-700">Sistem Online</p>
                        </div>
                        <p class="text-xs text-emerald-600 mt-1">Semua layanan berjalan normal</p>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden md:ml-72">
                <livewire:layout.navigation />

                @if (isset($header))
                    <header class="bg-white border-b border-slate-200 shadow-sm mt-16">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-slate-900">{{ $header }}</h2>
                                    <p class="text-xs text-slate-500">Kemenkum Bali</p>
                                </div>
                            </div>
                        </div>
                    </header>
                @endif

                <main class="flex-1 overflow-y-auto p-4 md:p-8 bg-slate-50 mt-16">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const body = document.body;
                
                // Find hamburger button di navbar (Mobile Menu Button)
                const navMenuBtn = document.querySelector('nav button[class*="sm:hidden"]');
                if (!navMenuBtn) return;

                // Track sidebar state saat tablet portrait
                const isMobileMenu = () => window.innerWidth >= 768 && window.matchMedia('(orientation: portrait)').matches;

                // Override hamburger behavior untuk tablet portrait
                navMenuBtn.addEventListener('click', function (e) {
                    if (isMobileMenu()) {
                        e.stopPropagation();
                        body.classList.toggle('show-sidebar');
                    }
                });

                // Tutup sidebar saat click di overlay (pseudo-element)
                const observer = new MutationObserver(() => {
                    // Try to detect overlay click through body click
                });
                
                // Klik di sidebar area untuk tutup
                const sidebar = document.querySelector('aside.fixed');
                if (sidebar) {
                    sidebar.addEventListener('click', (e) => {
                        if (e.target === sidebar) {
                            body.classList.remove('show-sidebar');
                        }
                    });
                }

                // Tutup sidebar saat orientasi berubah ke landscape
                window.addEventListener('orientationchange', () => {
                    setTimeout(() => {
                        if (!isMobileMenu()) {
                            body.classList.remove('show-sidebar');
                        }
                    }, 100);
                });
            });
        </script>
    </body>
</html>