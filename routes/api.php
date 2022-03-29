<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderDetailController;
use App\Http\Controllers\Api\OrderImageController;
use App\Http\Controllers\Api\OrderPaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductMaterialController;
use App\Http\Controllers\Api\ResponseFormatter;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\OrderSizeChartController;
use App\Models\Role;
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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('role', function () {
        $roles = Role::all();
        return ResponseFormatter::success($roles);
    });

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('user', [UserController::class, 'index']);
    Route::get('user/{user}', [UserController::class, 'show']);
    Route::post('user', [UserController::class, 'store']);
    Route::post('user/{user}', [UserController::class, 'update']);
    Route::delete('user/{user}', [UserController::class, 'destroy']);

    Route::get('customer', [CustomerController::class, 'index']);
    Route::get('customer_id', [CustomerController::class, 'indexGetId']);
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
    Route::get('product_not_paginate', [ProductController::class, 'indexnotpaginate']);
    Route::get('product/{product}', [ProductController::class, 'show']);
    Route::post('product', [ProductController::class, 'store']);
    Route::post('product/{product}', [ProductController::class, 'update']);
    Route::delete('product/{product}', [ProductController::class, 'destroy']);

    Route::get('order', [OrderController::class, 'index']);
    Route::get('order/pdf/print/{id}', [OrderController::class, 'printpdf']);
    Route::post('order', [OrderController::class, 'store']);
    Route::get('order/{order}', [OrderController::class, 'show']);
    Route::get('order/send_email/{order}', [OrderController::class, 'sendemail']);
    Route::post('order/{order}', [OrderController::class, 'update']);
    Route::delete('order/{order}', [OrderController::class, 'destroy']);

    Route::post('order_detail', [OrderDetailController::class, 'store']);
    Route::get('order_detail/{order_detail}', [OrderDetailController::class, 'show']);
    Route::post('order_detail/{order_detail}', [OrderDetailController::class, 'update']);
    Route::delete('order_detail/{order_detail}', [OrderDetailController::class, 'destroy']);

    Route::get('order_payment', [OrderPaymentController::class, 'index']);
    Route::post('order_payment', [OrderPaymentController::class, 'store']);
    Route::get('order_payment/{order_payment}', [OrderPaymentController::class, 'show']);
    Route::post('order_payment/{order_payment}', [OrderPaymentController::class, 'update']);
    Route::delete('order_payment/{order_payment}', [OrderPaymentController::class, 'destroy']);

    Route::get('order_image', [OrderImageController::class, 'index']);
    Route::post('order_image', [OrderImageController::class, 'create']);
    Route::delete('order_image/{order_image}', [OrderImageController::class, 'destroy']);

    Route::get('order_size_chart', [OrderSizeChartController::class, 'index']);
    Route::post('order_size_chart', [OrderSizeChartController::class, 'create']);
    Route::delete('order_size_chart/{order_size_chart}', [OrderSizeChartController::class, 'destroy']);
});
