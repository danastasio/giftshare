<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ItemController;
use App\Http\Controllers\Api\v1\ShareController;
use App\Http\Controllers\Api\v1\ClaimController;

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

Route::group(['prefix' => '/v1', 'middleware' => ['auth:sanctum', 'verified']], function () {
	// Application Endpoints
	Route::get('dashboard', [ItemController::class, 'index']);

	// Items API Endpoints
	Route::get('items',		[ItemController::class, 'list']);
	Route::post('items',	[ItemController::class, 'store']);
	Route::put('items/{item}',	[ItemController::class, 'update']);
	Route::delete('items',	[ItemController::class, 'destroy']);

	// Share API Endpoints
	Route::get('shares', [ShareController::class, 'index']);
	Route::post('shares', [ShareController::class, 'store']);
	Route::put('shares/{share}', [ShareController::class, 'update']);
	Route::delete('shares', [ShareController::class, 'destroy']);

	// Claim API Endpoints
	Route::get('claims', [ClaimController::class, 'index']);
	Route::post('claims', [ClaimController::class, 'store']);
	Route::delete('claims', [ClaimController::class, 'destroy']);
});

