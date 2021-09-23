<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index (Request $request) {
        return view('public.campaign.list');
    }

    public function detail($slug) {
        // $detail = Campaign::where('slug', $slug)->first();

        return view('public.campaign.detail');
    }
}
