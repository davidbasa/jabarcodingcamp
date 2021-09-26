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

        $user_id = auth()->user()->id;

        $campaign_attended = Donation::where(['status' => 'success', 'user_id' => $user_id])->count();
        $last_donation = Donation::with([
            'campaign',
            'campaign.category'
        ])
            ->where('user_id', $user_id)
            ->latest()
            ->limit(3)
            ->get();

        return view('user.dashboard', compact([
            'campaign_attended',
            'last_donation'
        ]));
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
            Alert::error('Error', 'Email sudah digunakan');
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

            Alert::success('Berhasil!', 'Informasi akun sudah diperbarui');
            return redirect()->back();
        } catch(Exception $e) {
            return redirect()->back();
        }
    }

    public function donasi () {
        $user_id = auth()->user()->id;

        $last_donation = Donation::with([
            'campaign',
            'campaign.category'
        ])
            ->where('user_id', $user_id)
            ->latest()
            ->get();

        return view('user.donation.list', compact([
            'last_donation'
        ]));
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
