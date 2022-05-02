<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\AuthController;


Route::apiResource('/product', ProductsController::class)->only(['index', 'show']);
Route::apiResource('/category', CategoryController::class)->only(['index', 'show']);
Route::apiResource('/size', SizesController::class)->only(['store'])->only(['index', 'show']);
Route::apiResource('/message', MessagesController::class)->only(['store']);

Route::post('/user', [UsersController::class, 'store']);
Route::post('/user-login', [AuthController::class, 'signIn']);

Route::middleware(['auth:sanctum', 'abilities:role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('/product', ProductsController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/user', UsersController::class);
    Route::apiResource('/size', SizesController::class);
    Route::apiResource('/message', MessagesController::class);
    Route::apiResource('/address', AddressController::class);
    Route::apiResource('/order', OrdersController::class);
    Route::get('/order/invoice/{order}', [OrdersController::class, 'orderInvoice']);
});

Route::middleware(['auth:sanctum', 'abilities:role:user'])->prefix('user')->group(function () {
    Route::apiResource('/user', UsersController::class)->except(['index', 'store']);
    Route::apiResource('/address', AddressController::class);
    Route::apiResource('/order', OrdersController::class)->only(['index', 'show', 'store']);
});

Route::middleware(['auth:sanctum', 'abilities:anyone'])->group(function () {
    Route::post('/user-auth', [AuthController::class, 'userAuth']);
    Route::post('/user-signout', [AuthController::class, 'signOut']);
});

