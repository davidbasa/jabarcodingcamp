<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;


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

Route::prefix('/admin-area')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{user_id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user_id}', [UserController::class, 'update'])->name('user.update');

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment',[PaymentController::class, 'store'])->name('payment.store');
    Route::get('payment/{payment_id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::put('/payment/{payment_id}', [PaymentController::class, 'update'])->name('payment.update');
    Route::delete('/payment/{payment_id}',[PaymentController::class, 'destroy'])->name('payment.delete');
});

Route::prefix('/donatur-area')
    ->middleware('auth')
    ->as('donatur.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'donatur'])->name('dashboard');
});


// Route::get('/anu', function () {
//     return view('admin.user.edit');
// });

