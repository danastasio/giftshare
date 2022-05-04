<?php

// uncomment the next three to disable email verification
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// controllers go here
use App\Http\Controllers\ShareController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminPanel;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\CollectionController;

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
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
    Route::get('/', [ItemController::class, 'index'])->name('index');

    Route::resource('item', ItemController::class);
    Route::resource('share', ShareController::class);
    Route::resource('claim', ClaimController::class);
    Route::resource('admin', AdminPanel::class);
    Route::resource('collection', CollectionController::class);
    Route::get('/list', [ItemController::class, 'list'])->name('list');
    Route::get('/deleted', [ItemController::class, 'deleted'])->name('deleted');

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

