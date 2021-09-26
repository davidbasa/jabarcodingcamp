<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\{
    Campaign,
    Donation,
    Payment
};

class DonationController extends Controller
{
    public function create($campaign_slug) {
        $campaign = Campaign::slug($campaign_slug);

        if(!$campaign) {
            Alert::error('Campaign tidak ditemukan', 'Reload halaman lalu silahkan coba lagi');
            return redirect()->back();
        }

        $payment = Payment::latest()->get();

        return view('public.donation.create', compact([
            'campaign', 'payment'
        ]));
    }

    public function store ($campaign_slug, Request $request) {

        $campaign = Campaign::slug($campaign_slug);

        if(!$campaign) {
            Alert::error('Campaign tidak ditemukan', 'Reload halaman lalu silahkan coba lagi');
            return redirect()->back();
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment'=> 'required|exists:payment_methods,id'
        ]);

        try {

            $donation = Donation::create([
                'campaign_id' => $campaign->id,
                'amount' => $request->amount,
                'payment_id' => $request->payment,
                'status' => 'waiting_transfer',
                'comment' => $request->comment,
                'anonym' => $request->input('anonym') ? true : false,
                'user_id' => auth()->user()->id
            ]);

            Alert::success('Berhasil', 'Donasi telah dibuat! silahkan lakukan pembayaran');
            return redirect()->route('donatur.donasi.detail', $donation->id);

        } catch (\Exception $e) {
            Alert::error('Gagal membuat donasi', 'Silahkan coba lagi');
            return redirect()->back();
        }
    }

    public function admin()
    {
        if(isAdmin()){
            return view ('admin.donation.index', [
                'data' => Donation::latest()->get()
            ]);
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }

    public function status(Request $request)
    {
        if(isAdmin()){
            $request->validate([
                'id' => 'required',
                'status' => 'required',
            ]);

            Donation::where('id', $request->id)->update(['status' => 'success']);
            
            Alert::success('Berhasil!', 'Donasi berhasil diterima!');
            return redirect(route('donation.admin'));
        } else {
            Alert::error('403 - Unauthorized', 'Anda tidak memiliki kewenangan untuk mengakses halaman ini!');
            return redirect()->back();
        }
    }
}
