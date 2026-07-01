<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIDESA Admin</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        sidesa: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Bootstrap (For Modals/JS if needed, scoped) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; color: #334155; }
        /* Fix Bootstrap conflict with Tailwind Preflight */
        a { text-decoration: none; }
        .sidebar-item { transition: all 0.3s ease; }
        .sidebar-item:hover, .sidebar-item.active {
            background-color: rgba(255,255,255,0.1); /* Sidebar Hover */
            transform: translateX(5px);
        }
        .sidebar-item.active {
            border-left: 4px solid #4ade80;
            background-color: rgba(255,255,255,0.15);
        }
        .content-card {
            background: #ffffff; /* Card */
            border: 1px solid #e2e8f0; /* Border */
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            padding: 24px;
            transition: all 0.3s ease;
        }
        .content-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Table Styles */
        table th { background: #f8fafc !important; color: #64748b !important; border-color: #e2e8f0 !important; }
        table td { border-color: #e2e8f0 !important; color: #475569; }
        tr:hover td { background: rgba(248,250,252,0.8) !important; }
    </style>
    @stack('styles')
</head>
<body class="antialiased overflow-x-hidden flex h-screen selection:bg-sidesa-500 selection:text-white">

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-72 h-full flex flex-col fixed left-0 top-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl bg-gradient-to-b from-sidesa-900 to-sidesa-800">
        
        <!-- Logo -->
        <div class="p-6 border-b border-white/10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center border border-white/30 shadow-inner">
                    <i class="fa-solid fa-shield-halved text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-white font-bold text-xl tracking-wide m-0">SIDESA</h2>
                    <p class="text-sidesa-100/80 text-xs font-medium m-0">Admin Panel</p>
                </div>
            </div>
            <button onclick="toggleSidebar()" class="lg:hidden text-white/70 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Menu -->
        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
            @php
                $currentRoute = Route::currentRouteName();
            @endphp
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl text-white font-medium {{ $currentRoute == 'admin.dashboard' ? 'active' : '' }}">
                <div class="w-8 flex justify-center"><i class="fa-solid fa-chart-pie text-lg {{ $currentRoute == 'admin.dashboard' ? 'text-sidesa-300' : 'text-sidesa-100/70' }}"></i></div>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.pengurus.index') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl text-white font-medium {{ Str::startsWith($currentRoute, 'admin.pengurus') ? 'active' : '' }}">
                <div class="w-8 flex justify-center"><i class="fa-solid fa-users-gear text-lg {{ Str::startsWith($currentRoute, 'admin.pengurus') ? 'text-sidesa-300' : 'text-sidesa-100/70' }}"></i></div>
                <span>Pemerintahan</span>
            </a>

            <a href="{{ route('admin.pengaduan') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl text-white font-medium {{ Str::startsWith($currentRoute, 'admin.pengaduan') ? 'active' : '' }}">
                <div class="w-8 flex justify-center"><i class="fa-solid fa-bullhorn text-lg {{ Str::startsWith($currentRoute, 'admin.pengaduan') ? 'text-sidesa-300' : 'text-sidesa-100/70' }}"></i></div>
                <span>Pengaduan</span>
            </a>

            <a href="{{ route('admin.pengajuan.index') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl text-white font-medium {{ Str::startsWith($currentRoute, 'admin.pengajuan') ? 'active' : '' }}">
                <div class="w-8 flex justify-center"><i class="fa-solid fa-file-signature text-lg {{ Str::startsWith($currentRoute, 'admin.pengajuan') ? 'text-sidesa-300' : 'text-sidesa-100/70' }}"></i></div>
                <span>Pengajuan Surat</span>
            </a>

            <a href="{{ route('admin.agenda.index') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl text-white font-medium {{ Str::startsWith($currentRoute, 'admin.agenda') ? 'active' : '' }}">
                <div class="w-8 flex justify-center"><i class="fa-solid fa-calendar-days text-lg {{ Str::startsWith($currentRoute, 'admin.agenda') ? 'text-sidesa-300' : 'text-sidesa-100/70' }}"></i></div>
                <span>Agenda Desa</span>
            </a>

            <a href="{{ route('admin.berita.index') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl text-white font-medium {{ Str::startsWith($currentRoute, 'admin.berita') ? 'active' : '' }}">
                <div class="w-8 flex justify-center"><i class="fa-solid fa-newspaper text-lg {{ Str::startsWith($currentRoute, 'admin.berita') ? 'text-sidesa-300' : 'text-sidesa-100/70' }}"></i></div>
                <span>Berita</span>
            </a>

            <a href="{{ route('admin.settings.peta') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl text-white font-medium {{ Str::startsWith($currentRoute, 'admin.settings') ? 'active' : '' }}">
                <div class="w-8 flex justify-center"><i class="fa-solid fa-map-location-dot text-lg {{ Str::startsWith($currentRoute, 'admin.settings') ? 'text-sidesa-300' : 'text-sidesa-100/70' }}"></i></div>
                <span>Pengaturan Peta</span>
            </a>
        </div>
        
        <!-- Bottom Section -->
        <div class="p-4 border-t border-white/10">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 rounded-xl text-sidesa-100/80 font-medium hover:bg-red-500/20 hover:text-white group border-none bg-transparent transition-all">
                    <div class="w-8 flex justify-center"><i class="fa-solid fa-right-from-bracket text-lg text-red-300/80 group-hover:text-red-200"></i></div>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full lg:ml-72 w-full transition-all duration-300 relative z-10">
        
        <!-- Header -->
        <header class="glass-header sticky top-0 z-30 px-6 py-4 flex justify-between items-center h-20">
            <div class="flex items-center gap-3 md:gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden w-10 h-10 rounded-xl bg-white flex items-center justify-center text-slate-600 hover:bg-slate-50 hover:text-sidesa-600 transition-colors border border-slate-200 shrink-0">
                    <i class="fa-solid fa-bars"></i>
                </button>
                
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-sidesa-600 bg-white hover:bg-slate-50 px-3 py-1.5 rounded-full transition-colors border border-slate-200 shrink-0 shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i> <span class="hidden sm:inline">Back ke Website SIDESA</span>
                </a>

                <div class="h-6 w-px bg-slate-300 hidden sm:block"></div>

                <h1 class="text-lg md:text-2xl font-bold text-slate-800 m-0 leading-none truncate max-w-[150px] sm:max-w-none">@yield('header')</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="text-xs text-sidesa-600 font-semibold px-2 py-0.5 bg-sidesa-50 rounded-full border border-sidesa-100 mt-1">Admin Desa</span>
                </div>
                <div class="relative group cursor-pointer">
                    <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : 'https://i.pravatar.cc/100' }}" alt="Profile" class="w-11 h-11 rounded-full object-cover ring-2 ring-slate-100 ring-offset-2 ring-offset-white transition-all group-hover:ring-sidesa-500">
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            <div class="fade-in animate-[fadeIn_0.3s_ease-in-out]">
                @yield('content')
            </div>
        </div>

    </main>

    <!-- Scripts -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('scripts')
</body>
</html>
