<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\{
    User,
    Donation
};

class DonaturController extends Controller
{
    public function index() {
        return view('user.dashboard');
    }

    public function profile () {
        return view('user.profile');
    }

    public function update_profile (Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = auth()->user();

        $usedEmail = User::where('email', $request->email)->first();

        if($usedEmail && $usedEmail->id != $user->id) {
            return redirect()->back();
        }

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if($request->password) {
                $data['password'] = bcrypt($request->password);
            }

            $ok = $user->update($data);

            return redirect()->back();
        } catch(Exception $e) {
            return redirect()->back();
        }
    }

    public function donasi () {
        
    }

    public function detail ($id) {
        $donation = Donation::where([
            'id' => $id,
            'user_id' => auth()->user()->id
        ])
        ->with([
            'payment',
            'campaign'
        ])
        ->first();

        if(!$donation) {
            Alert::error('Error', 'Donasi tidak ditemukan');
            return redirect()->back();
        }

        return view('user.donation.detail', [
            'donation' => $donation,
            'campaign' => $donation->campaign,
            'payment' => $donation->payment
        ]);
    }
}
