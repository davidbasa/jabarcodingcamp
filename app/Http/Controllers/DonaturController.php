<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    User
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
}
