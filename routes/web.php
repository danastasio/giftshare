<?php

use Illuminate\Support\Facades\Route;
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

