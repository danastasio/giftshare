<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ItemController;
use App\Http\Controllers\Api\v1\ShareController;

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

Route::group(['prefix' => '/v1', 'namespace' => 'Api\v1', 'middleware' => ['auth:sanctum', 'verified']], function () {
	Route::get('item/dashboard',[ItemController::class, 'index']);
	Route::get('item/list',		[ItemController::class, 'list']);
	Route::post('item/store',	[ItemController::class, 'store']);
	Route::post('item/destroy',	[ItemController::class, 'destroy']);
	Route::post('item/update',	[ItemController::class, 'update']);
	Route::get('share/index',	[ShareController::class, 'index']);
	Route::post('share/store',	[ShareController::class, 'store']);
	Route::post('share/destroy',[ShareController::class, 'destroy']);
});

