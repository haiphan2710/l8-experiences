<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Login View
     *
     * @return RedirectResponse | View
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login', ['isError' => true]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login.view');
    }
}
