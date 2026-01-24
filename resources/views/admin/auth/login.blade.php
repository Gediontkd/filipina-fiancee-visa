{{-- resources/views/admin/auth/login.blade.php (Modified for One-Click) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="bg-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Portal</h1>
            <p class="text-blue-100">Quick access to admin dashboard</p>
        </div>

        <!-- One-Click Login -->
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Quick Access</h2>
                <p class="text-gray-600 text-sm">Click below for instant admin access</p>
            </div>

            <!-- Quick Login Button -->
            <form method="POST" action="{{ route('admin.login') }}" id="quick-login-form">
                @csrf
                <input type="hidden" name="email" value="support@filipinafianceevisa.com">
                <input type="hidden" name="password" value="Admin123">
                <input type="hidden" name="remember" value="1">
                
                <button type="submit" 
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 mb-4">
                    <i class="fas fa-bolt mr-2"></i>Quick Admin Access
                </button>
            </form>

            <!-- Manual Login Toggle -->
            <button onclick="toggleManualLogin()" 
                    class="w-full text-sm text-gray-500 hover:text-gray-700 underline">
                Use manual login instead
            </button>

            <!-- Manual Login Form (Hidden by Default) -->
            <form method="POST" action="{{ route('admin.login') }}" id="manual-login-form" style="display: none;" class="mt-4">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <input type="password" name="password" placeholder="Password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg">
                    Manual Login
                </button>
            </form>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <script>
        function toggleManualLogin() {
            const quickForm = document.getElementById('quick-login-form').parentElement;
            const manualForm = document.getElementById('manual-login-form');
            
            if (manualForm.style.display === 'none') {
                quickForm.style.display = 'none';
                manualForm.style.display = 'block';
            } else {
                quickForm.style.display = 'block';
                manualForm.style.display = 'none';
            }
        }
    </script>
</body>
</html>