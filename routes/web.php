<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// auth
Route::get('/', [AuthController::class, 'loginPage'])->name('login_page');
Route::get('login_page', [AuthController::class, 'loginPage'])->name('login_page');
Route::get('register_page', [AuthController::class, 'registerPage'])->name('register_page');
Route::get('authenticated', [AuthController::class, 'authenticated']);
Route::get('auth/google/redirect', [GoogleController::class, 'googleRedirect']);
Route::get('auth/google/callback', [GoogleController::class, 'googleCallback']);
// admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')->name('admin.')->group(function () {

    Route::get('home', [AdminController::class, 'home'])->name('home');
    // categories
    Route::get('category', [CategoryController::class, 'list'])->name('category.list');
    Route::get('category/add', [CategoryController::class, 'index'])->name('category.add');
    Route::post('category/add', [CategoryController::class, 'store'])->name('category.add');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('category/update', [CategoryController::class, 'updateStore'])->name('category.update');

    // admin list
    Route::get('admin/list', [AdminController::class, 'list'])->name('admin.list');
    Route::get('admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    // customer list
    Route::get('customer/list', [UserController::class, 'list'])->name('customer.list');
    Route::get('ajax/user_delete', [UserController::class, 'delete']);

    // profile
    Route::get('profile/detail', [AdminController::class, 'profileDetail'])->name('profile.detail');
    Route::get('profile/edit', [AdminController::class, 'profileEdit'])->name('profile.edit');
    Route::post('profile/edit', [AdminController::class, 'profileEditStore']);

    // products
    Route::get('product/list', [ProductController::class, 'list'])->name('product.list');
    Route::get('product/create', [ProductController::class, 'createPage'])->name('product.create');
    Route::post('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('product/update/{id}', [ProductController::class, 'updatePage'])->name('product.update');
    Route::post('product/update', [ProductController::class, 'update'])->name('product.update');

    // order
    Route::get('order', [OrderController::class, 'list'])->name('order.list');
    Route::get('ajax/status', [OrderController::class, 'changeStatus']);
    Route::get('order/detail/{orderCode}', [OrderController::class, 'detail'])->name('order.detail');

    // contact
    Route::get('contact', [ContactController::class, 'contactInex'])->name('contact');
    Route::get('contact/detail/{id}', [ContactController::class, 'detail'])->name('contact.detail');
    Route::get('ajax/contact_delete', [AjaxController::class, 'contactDelete']);

    // change password
    Route::get('change_password', [AdminController::class, 'changePassword'])->name('change_password');
    Route::post('change_password', [AdminController::class, 'changePasswordStore'])->name('change_password');
});

// user
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('home', [UserController::class, 'home'])->name('home');
    Route::get('product/detail/{id}', [PageController::class, 'productDetail'])->name('product_detail');
    Route::get('product/cart', [PageController::class, 'cart'])->name('product.cart');
    Route::get('product/order', [PageController::class, 'order'])->name('product.order');

    // profile
    Route::get('change_password', [UserController::class, 'chagePassword'])->name('change_password');
    Route::post('change_password', [UserController::class, 'changePasswordStore'])->name('change_password');

    // contact
    Route::get('contact', [PageController::class, 'index'])->name('contact');

    // ajax call
    Route::get('ajax/sorting', [AjaxController::class, 'sorting']);
    Route::get('ajax/cart', [AjaxController::class, 'cart']);
    Route::get('ajax/remove_cart', [AjaxController::class, 'remove']);
    Route::get('ajax/plus_cart', [AjaxController::class, 'plus']);
    Route::get('ajax/order', [AjaxController::class, 'order']);
    Route::get('ajax/increase-view_count', [AjaxController::class, 'IncViewCount']);
    Route::get('ajax/send_message', [AjaxController::class, 'sendMessage']);
});