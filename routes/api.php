<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ShoppingSession;

use App\Http\Controllers\Auth\AuthController;

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

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function (){
    Route::post('/shoppingCart', [\App\Http\Controllers\Api\ShoppingCartController::class, 'stoclearre']);
});


Route::apiResource('posts', PostController::class);
Route::apiResource('discounts', DiscountController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
//Route::apiResource('users', UserController::class);
