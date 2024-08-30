<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama Dibutuhkan',
            'email.required' => 'Email Dibutuhkan',
            'email.email' => 'Tipe Harus Email',
            'email.unique' => 'Email Sudah Ada',
            'password.required' => 'Password Dibutuhkan',
            'password.min' => 'Minimal 8 Karakter'
        ]);
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($request->password);
        Customers::create($validatedData);
        flash('Berhasil Menyimpan Data Customers');
        return redirect()->route('login');
    }
}
