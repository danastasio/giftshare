<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllerv1;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
	// v1
		Route::post('/v1/hello', [ApiControllerv1::class, 'hello'])->name('hello');
		Route::post('/v1/item/create', [ApiControllerv1::class, 'item_create'])->name('item_create');
		Route::post('/v1/item/read', [ApiControllerv1::class, 'item_read'])->name('item_read');
		Route::post('/v1/item/update', [ApiControllerv1::class, 'item_update'])->name('item_update');
		Route::post('/v1/item/delete', [ApiControllerv1::class, 'item_delete'])->name('item_delete');
		Route::post('/v1/item/claim', [ApiControllerv1::class, 'item_claim'])->name('item_claim');
		Route::post('/v1/item/unclaim', [ApiControllerv1::class, 'item_unclaim'])->name('item_unclaim');
		Route::post('/v1/share/create', [ApiControllerv1::class, 'share_create'])->name('share_create');
		Route::post('/v1/share/read', [ApiControllerv1::class, 'share_read'])->name('share_read');
		Route::post('/v1/share/delete', [ApiControllerv1::class, 'share_delete'])->name('share_delete');
});
