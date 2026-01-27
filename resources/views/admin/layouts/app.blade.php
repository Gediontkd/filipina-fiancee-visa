{{-- resources/views/admin/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        sidebar: { DEFAULT: '#0f172a', hover: '#1e293b', active: '#3b82f6' }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

        @media print {
            /* 1. Reset Global Layout */
            html, body {
                height: auto !important;
                min-height: auto !important;
                overflow: visible !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* 2. Hide Non-Printable Elements */
            aside, header, [x-show="sidebarOpen"], 
            button, .no-print { 
                display: none !important; 
            }

            /* 3. Force Main Content to Expand and Kill Full-Height Constraints */
            .flex, .flex-col, .h-full, .min-h-screen, 
            .overflow-hidden, .overflow-y-auto, 
            main, div {
                display: block !important;
                height: auto !important;
                min-height: 0 !important; /* CRITICAL FIX: Overrides 100vh constraints */
                overflow: visible !important;
                position: static !important;
            }

            /* 4. Reset Specific Layout Containers */
            /* We need to specifically target the layout structure */
            body > div.flex {
                display: block !important;
            }

            main {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }

            /* 5. Pagination & Spacing */
            /* Ensure sections don't break awkwardly */
            .bg-white, .rounded-lg, .shadow {
                box-shadow: none !important;
                border: 1px solid #ddd !important; /* Add light border for clarity */
                margin-bottom: 20px !important;
                /* break-inside: avoid;  <-- REMOVE THIS to stop forced page breaks */
            }

            h3, h4, h5 {
                break-after: avoid;
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body class="h-full bg-slate-50 font-sans antialiased" x-data="{ sidebarOpen: false, searchOpen: false }">
    <div class="flex h-full">
        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-black/50 lg:hidden"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-sidebar transform transition-transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col">
            
            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-halved text-white text-sm"></i>
                    </div>
                    <span class="text-white font-semibold text-lg">Admin</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin">
                @include('admin.partials.nav-item', [
                    'route' => 'admin.dashboard',
                    'icon' => 'fa-chart-line',
                    'label' => 'Dashboard',
                    'active' => request()->routeIs('admin.dashboard')
                ])
                
                @include('admin.partials.nav-item', [
                    'route' => 'admin.users.index',
                    'icon' => 'fa-users',
                    'label' => 'Users',
                    'active' => request()->routeIs('admin.users.*'),
                    'badge' => null
                ])
                
                @include('admin.partials.nav-item', [
                    'route' => 'admin.applications.index',
                    'icon' => 'fa-file-lines',
                    'label' => 'Applications',
                    'active' => request()->routeIs('admin.applications.*'),
                    'badge' => \App\Models\UserSubmittedApplication::where('status', 'pending')->count() ?: null
                ])

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-medium text-slate-500 uppercase tracking-wider">Documents</p>
                </div>
                
                @include('admin.partials.nav-item', [
                    'route' => 'admin.documents.uploaded.index',
                    'icon' => 'fa-cloud-arrow-up',
                    'label' => 'Uploads',
                    'active' => request()->is('admin/documents/uploaded*'),
                    'badge' => \App\Models\DropBox::where('is_verified', false)->count() ?: null
                ])
                
                @include('admin.partials.nav-item', [
                    'route' => 'admin.documents.management.index',
                    'icon' => 'fa-folder-tree',
                    'label' => 'Requirements',
                    'active' => request()->is('admin/documents/management*')
                ])
                @include('admin.partials.nav-item', [
                  'route' => 'admin.user-pdf-store.index',
                  'icon' => 'fa-file-pdf',
                  'label' => 'User PDF Store',
                  'active' => request()->is('admin/user-pdf-store*')
                  ])


                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-medium text-slate-500 uppercase tracking-wider">Communication</p>
                </div>
                
                @php $unreadMessages = \App\Models\Message::where('sender_type', 'user')->whereNull('read_at')->count(); @endphp
                @include('admin.partials.nav-item', [
                    'route' => 'admin.messages.index',
                    'icon' => 'fa-envelope',
                    'label' => 'Messages',
                    'active' => request()->routeIs('admin.messages.*'),
                    'badge' => $unreadMessages ?: null
                ])
                
                @php $unreadChanges = \App\Models\MonitoringChange::unread()->count(); @endphp
                @include('admin.partials.nav-item', [
                    'route' => 'admin.monitoring.index',
                    'icon' => 'fa-bell',
                    'label' => 'Monitoring',
                    'active' => request()->routeIs('admin.monitoring.*'),
                    'badge' => $unreadChanges ?: null
                ])
            </nav>

            <!-- User Menu -->
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">
                            {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::guard('admin')->user()->name }}</p>
                        <p class="text-xs text-slate-400">Administrator</p>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-white" title="Logout">
                            <i class="fas fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 lg:px-6">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-slate-800">@yield('page-title', 'Dashboard')</h1>
                </div>
                
                <div class="flex items-center space-x-3">
                    <!-- Global Search -->
                    <div class="relative" x-data="{ query: '' }">
                        <button @click="searchOpen = !searchOpen" class="p-2 text-slate-500 hover:text-slate-700">
                            <i class="fas fa-search"></i>
                        </button>
                        <div x-show="searchOpen" x-cloak @click.away="searchOpen = false"
                             class="absolute right-0 top-full mt-2 w-80 bg-white rounded-lg shadow-lg border p-3">
                            <input type="text" x-model="query" placeholder="Search users, applications..."
                                   class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <span class="text-sm text-slate-500 hidden md:block">{{ now()->format('M j, Y') }}</span>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @include('admin.partials.flash-messages')
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>