<?php
// app/Http/Controllers/Admin/AuthController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $admin = Auth::guard('admin')->user();
            
            if (!$admin->isActive()) {
                Auth::guard('admin')->logout();
                throw ValidationException::withMessages([
                    'email' => 'Your admin account has been deactivated.',
                ]);
            }

            $admin->updateLastLogin();
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome back, ' . $admin->name . '!');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
 * Admin instant login to user account
 */
public function loginAsUser(Request $request, User $user)
{
    $admin = Auth::guard('admin')->user();
    
    // Log this action for security audit
    \Log::info('Admin login as user', [
        'admin_id' => $admin->id,
        'admin_email' => $admin->email,
        'user_id' => $user->id,
        'user_email' => $user->email,
        'ip' => $request->ip(),
        'timestamp' => now()
    ]);
    
    // Store admin ID in session to allow returning to admin panel
    session(['admin_viewing_as_user' => true]);
    session(['original_admin_id' => $admin->id]);
    
    // Logout from admin guard
    Auth::guard('admin')->logout();
    
    // Login as the user
    Auth::login($user, true);
    
    // Regenerate session for security
    $request->session()->regenerate();
    
    return redirect()->route('user.page', ['page' => 'progress'])
        ->with('success', 'You are now viewing as ' . $user->name);
}
}