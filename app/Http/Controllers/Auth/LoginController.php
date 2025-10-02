<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Always redirect to progress page after login
        return route('user.page', ['page' => 'progress']);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}