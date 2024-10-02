<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin');
            } elseif (auth()->user()->isManager()) {
                return redirect()->route('manager');
            } else {
                return redirect()->route('toppage_logged_in');
            }
        }

        return redirect()->back()->withInput()->withErrors(['password' => 'パスワードが違います！']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
