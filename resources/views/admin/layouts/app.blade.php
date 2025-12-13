{{-- resources/views/admin/layouts/app.blade.php (UPDATED VERSION) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js for messaging panel -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .sidebar-link.active {
            @apply bg-blue-700 text-white;
        }
        
        .sidebar-link:hover {
            @apply bg-blue-700 text-white;
        }

        /* Messaging panel styles */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Mobile sidebar backdrop -->
        <div id="sidebar-backdrop" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden lg:hidden"></div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-blue-800 transform -translate-x-full transition-transform lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-between p-4 border-b border-blue-700">
                <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                <button id="close-sidebar" class="text-white lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <nav class="p-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-link flex items-center px-3 py-2 text-blue-100 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Dashboard
                </a>
                
                <!-- User Management -->
                <a href="{{ route('admin.users.index') }}" 
                   class="sidebar-link flex items-center px-3 py-2 text-blue-100 rounded-lg {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    User Management
                </a>
                
                <!-- Applications -->
                <a href="{{ route('admin.applications.index') }}" 
                   class="sidebar-link flex items-center px-3 py-2 text-blue-100 rounded-lg {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt mr-3"></i>
                    Applications
                </a>

                <!-- Uploaded Documents -->
                <a href="{{ route('admin.documents.uploaded.index') }}" 
                   class="sidebar-link flex items-center justify-between px-3 py-2 text-blue-100 rounded-lg {{ request()->is('admin/documents/uploaded*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <i class="fas fa-file-upload mr-3"></i>
                        <span>Uploaded Documents</span>
                    </div>
                    @php
                        $unverifiedCount = \App\Models\DropBox::where('is_verified', false)->count();
                    @endphp
                    @if($unverifiedCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                            {{ $unverifiedCount }}
                        </span>
                    @endif
                </a>

                <!-- Document Settings -->
                <a href="{{ route('admin.documents.management.index') }}" 
                   class="sidebar-link flex items-center px-3 py-2 text-blue-100 rounded-lg {{ request()->is('admin/documents/management*') ? 'active' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Document Settings</span>
                </a>

                <!-- Change Monitoring -->
                <a href="{{ route('admin.monitoring.index') }}" 
                   class="sidebar-link flex items-center justify-between px-3 py-2 text-blue-100 rounded-lg {{ request()->routeIs('admin.monitoring.*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <i class="fas fa-search mr-3"></i>
                        <span>Change Monitoring</span>
                    </div>
                    @php
                        $unreadCount = \App\Models\MonitoringChange::unread()->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <!-- Messages -->
                <a href="{{ route('admin.messages.index') }}" 
                   class="sidebar-link flex items-center justify-between px-3 py-2 text-blue-100 rounded-lg {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <div class="flex items-center">
                        <i class="fas fa-comments mr-3"></i>
                        <span>Messages</span>
                    </div>
                    @php
                        $unreadMsgCount = \App\Models\Message::where('sender_type', 'user')->whereNull('read_at')->count();
                    @endphp
                    @if($unreadMsgCount > 0)
                        <span class="unread-count inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                            {{ $unreadMsgCount }}
                        </span>
                    @endif
                </a>
            </nav>
            
            <!-- Admin Profile & Logout (Bottom) -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-blue-700">
                <div class="text-blue-100 text-sm mb-2">
                    {{ Auth::guard('admin')->user()->name }}
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-blue-100 hover:text-white">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <button id="open-sidebar" class="text-gray-600 lg:hidden mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-lg font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Global Messaging Panel Component -->
                        <x-messaging-panel userType="admin" />
                        
                        <span class="text-sm text-gray-500 hidden sm:block">
                            {{ now()->format('M j, Y') }}
                        </span>
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-medium">
                                {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-auto">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none'">
                            <i class="fas fa-times"></i>
                        </span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none'">
                            <i class="fas fa-times"></i>
                        </span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile sidebar toggle
        const openSidebar = document.getElementById('open-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        openSidebar?.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
        });

        closeSidebar?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        });

        backdrop?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        });

        // Auto-hide alerts after 5 seconds
        document.querySelectorAll('[role="alert"]').forEach(alert => {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>
</html>