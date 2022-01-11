<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductMaterialController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function (){
    Route::get('customer', [CustomerController::class, 'index']);
    Route::get('customer/{customer}', [CustomerController::class, 'show']);
    Route::post('customer', [CustomerController::class, 'store']);
    Route::post('customer/{customer}', [CustomerController::class, 'update']);
    Route::delete('customer/{customer}', [CustomerController::class, 'destroy']);

    Route::get('product_material', [ProductMaterialController::class, 'index']);
    Route::get('product_material/{product_material}', [ProductMaterialController::class, 'show']);
    Route::post('product_material', [ProductMaterialController::class, 'store']);
    Route::post('product_material/{product_material}', [ProductMaterialController::class, 'update']);
    Route::delete('product_material/{product_material}', [ProductMaterialController::class, 'destroy']);

    
    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/{product}', [ProductController::class, 'show']);
    Route::post('product', [ProductController::class, 'store']);
    Route::post('product/{product}', [ProductController::class, 'update']);
    Route::delete('product/{product}', [ProductController::class, 'destroy']);

    Route::get('order', [OrderController::class, 'index']);
    Route::post('order', [OrderController::class, 'store']);
});
//CUSTOMER
