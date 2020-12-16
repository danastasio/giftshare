<?php

// uncomment the next three items if you're disabling email verification
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// controllers go here
use App\Http\Controllers\SharingController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\AdminPanel;

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

Route::get('/', function () {
	return view('auth/login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
	Route::get('/dashboard',[ItemsController::class, 'index'])->name('dashboard');
	Route::get('/',[ItemsController::class, 'index'])->name('index');

	Route::resource('items', ItemsController::class);
	Route::resource('sharecontrol', SharingController::class);
	Route::post('/claim', [ItemsController::class, 'claim'])->name('claim');
	Route::post('/unclaim', [ItemsController::class, 'unclaim'])->name('unclaim');
	Route::get('/sharing', [SharingController::class, 'index'])->name('sharing');
	Route::get('/list', [ItemsController::class, 'list'])->name('list');
	Route::resource('admin', AdminPanel::class);
});

// below routes are for email verification
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
