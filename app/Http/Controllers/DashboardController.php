<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function admin()
    {
        if(isAdmin()){
            return view('admin.dashboard');
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
        
    }
    public function donatur()
    {
        if(!isAdmin()){
            return Auth::user()->name; // ini nanti diganti
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }
}
