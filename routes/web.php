<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\CampaignController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'public.landing')->name('index');

Route::view('tentang-kami', 'public.aboutus')->name('aboutus');
Route::view('hubungi-kami', 'public.contactus')->name('contactus');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'campaign', 'as' => 'campaign.'], function(){
    Route::get("", [CampaignController::class, 'index'])->name('list');
    Route::get("{id}", [CampaignController::class, 'detail'])->name('detail');
});

Route::group(['prefix' => 'donasi', 'as' => 'donation.'], function(){
    Route::get("{id}", [DonationController::class, 'create'])->name('create');
    Route::get("{id}/payment", [DonationController::class, 'payment'])->name('payment');
    Route::post("{id}", [DonationController::class, 'store'])->name('store');
});

Route::prefix('/admin-area')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});

Route::prefix('/donatur-area')
    ->middleware('auth')
    ->as('donatur.')
    ->group(function () {
        Route::get('/dashboard', [DonaturController::class, 'index'])->name('dashboard');
        Route::get('/donasi', [DonaturController::class, 'donasi'])->name('donasi');
        Route::get('/profil', [DonaturController::class, 'profile'])->name('profile');
        Route::post('/profil', [DonaturController::class, 'update_profile']);
});