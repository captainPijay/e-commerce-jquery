<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Login');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $validator->validated();

        if (Auth::guard('customers')->attempt($credentials)) {
            $request->session()->regenerate();
            flash('Berhasil Login customers');
            return redirect()->intended('/front-office/order-item');
        }
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            flash('Berhasil Login Users');
            return redirect()->intended('/back-office/dashboard');
        }
        flash()->addError('Gagal Login Email Atau Password Salah');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        flash('Berhasil Logout');
        return redirect('/login');
    }
}
