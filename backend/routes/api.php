<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class)->only(['store']);
Route::apiResource('carts', CartController::class)->only(['store', 'show']);
Route::post('carts/addProductToCart/{cartId}', [CartController::class, 'addProductToCart']);
Route::post('carts/checkout/{cartId}', [CartController::class, 'checkout']);
Route::apiResource('products', ProductController::class)->only(['index']);
