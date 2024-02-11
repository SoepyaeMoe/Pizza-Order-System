<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // logout
    Route::post('logout', [AuthController::class, 'logout']);

    // home data
    Route::get('home', [PageController::class, 'home']);

    // profile data
    Route::get('profile', [PageController::class, 'profile']);

    // products lists
    Route::get('products', [PageController::class, 'products']);

    // product detail
    Route::get('products/{id}', [PageController::class, 'productDetail']);

    // categories list
    Route::get('categories', [PageController::class, 'category']);

    // product list in cart
    Route::get('cart', [PageController::class, 'cart']);

    // remove product in cart
    Route::get('cart/remove/{id}', [PageController::class, 'removeCart']);

    // checkout product in cart
    Route::get('checkout', [PageController::class, 'checkout']);

    // order list and status
    Route::get('orders', [PageController::class, 'order']);

    // increase product quantity in cart list
    Route::post('products/addqty/{id}', [PageController::class, 'addQty']);

    // decrease product quantity in cart list
    Route::post('products/decqty/{id}', [PageController::class, 'decQty']);

    // sent message to contact with admin
    Route::post('contact', [PageController::class, 'contact']);

    // change password
    Route::post('change_password', [AuthController::class, 'changePassword']);

    // upload photo
    Route::post('upload_photo', [PageController::class, 'uploadPhoto']);

    // profile update
    Route::post('profile/update', [PageController::class, 'profileUpdate']);

    // check password
    Route::post('check_password', [PageController::class, 'checkPassword']);

    // delete accound
    Route::post('delete', [PageController::class, 'delete']);
});