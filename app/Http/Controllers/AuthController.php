<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return redirect('/admin-area/dashboard');
            } else {
                return redirect('/donatur-area/dashboard');
            }
        } else {
            return view('auth.login');
        }
    }

    public function authenticate(Request $request)
    {
        Cookie::forget('XSRF-TOKEN');
        Cookie::forget('laravel_session');

        $request->session()->flush();
        
        $check = [
            'email'  => $request->input('email'),
            'password'  => $request->input('password'),
        ];
        
        Auth::attempt($check);
        
        if (Auth::check()) { 
            Auth::logoutOtherDevices($request->password);
            Alert::toast('Selamat Datang di Jabar Bangkit Bersama!','success')->width('500px');
            if (Auth::user()->role_id == 1) {
                return redirect('/admin-area/dashboard');
            } else {
                return redirect('/donatur-area/dashboard');
            }
        } else { 
            Alert::error('Login gagal!', 'Email atau password salah!');
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::toast('Anda telah logout dari aplikasi Jabar Bangkit Bersama!','info')->width('500px');
        return redirect('/login');
    }

    public function register()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return redirect('/admin-area/dashboard');
            } else {
                return redirect('/donatur-area/dashboard');
            }
        } else {
            return view('auth.register');
        }
    }

    public function registered(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        unset($validated['confirm_password']);
        $validated['password'] = Hash::make($request->password);
        $validated['role_id'] = 2;

        User::create($validated);

        Alert::success('Pendaftaran berhasil!','Silahkan login untuk mulai berdonasi!')->width('500px');
        return redirect('/login');
    }
}
