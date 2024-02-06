<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('home', [PageController::class, 'home']);
    Route::get('profile', [PageController::class, 'profile']);
    Route::get('products', [PageController::class, 'products']);
    Route::get('products/{id}', [PageController::class, 'productDetail']);
    Route::get('categories', [PageController::class, 'category']);
    Route::get('cart', [PageController::class, 'cart']);
    Route::get('cart/remove/{id}', [PageController::class, 'removeCart']);
    Route::get('checkout', [PageController::class, 'checkout']);
    Route::get('orders', [PageController::class, 'order']);
    Route::post('products/addqty/{id}', [PageController::class, 'addQty']);
    Route::post('products/decqty/{id}', [PageController::class, 'decQty']);
    Route::post('contact', [PageController::class, 'contact']);
});