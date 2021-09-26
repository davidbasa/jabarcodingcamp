<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isAdmin()){
            return view ('admin.payment.index', [
                'payment' => Payment::get()
            ]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
                //return view('admin.payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required',
            'account' => 'required',
        ]);
        $query = DB::table('payment_methods')->insert([
            "name" => $request["name"],
            "logo" => $request["logo"],
            "account" => $request["account"],
        ]);
        return redirect(route('payment.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = DB::table('payment_methods')->first();
        return view('admin.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required',
            'account' => 'required',
        ]);
        $query = Payment::where('id', $id)
        ->update([
            "name" => $request["name"],
            "logo" => $request["logo"],
            "account" => $request["account"],
        ]);
        return redirect(route('payment.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isAdmin()){
            $state = Payment::destroy($id);
            $state ? Alert::success('Berhasil!', 'Data metode pembayaran berhasil dihapus!') : Alert::success('Error!', 'Data metode pembayaran gagal dihapus!');
            
            return redirect(route('payment.index'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    
    }
}
