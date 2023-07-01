<?php

declare(strict_types=1);

use App\Http\Controllers\API\Admin\Order\CancelOrderController;
use App\Http\Controllers\API\Admin\Order\ListOrderController;
use App\Http\Controllers\API\Admin\Order\MarkAsShippedController;
use App\Http\Controllers\API\Admin\Product\CreateProductController;
use App\Http\Controllers\API\Admin\Product\DeleteProductController;
use App\Http\Controllers\API\Admin\Product\ListProductController;
use App\Http\Controllers\API\Admin\Product\ShowProductController;
use App\Http\Controllers\API\Admin\Product\UpdateProductController;
use App\Http\Controllers\API\Authentication\LoginController;
use App\Http\Controllers\API\Authentication\LogoutController;
use App\Http\Controllers\API\User\Orders\AddToCartController;
use App\Http\Controllers\API\User\Orders\CheckoutController;
use App\Http\Controllers\API\User\Orders\CreateOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], static function () {
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::middleware('auth:sanctum')->group(function () {
        // Admin Routes
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function () {
            Route::group(['prefix' => 'products', 'as' => 'products.'], static function () {
                Route::get('/', ListProductController::class)->name('list');
                Route::post('/', CreateProductController::class)->name('create');
                Route::put('/{productId}', UpdateProductController::class)->name('update');
                Route::get('/{productId}', ShowProductController::class)->name('show');
                Route::delete('/{productId}', DeleteProductController::class)->name('remove');
            });

            Route::group(['prefix' => 'orders', 'as' => 'orders.'], static function () {
                Route::get('/', ListOrderController::class)->name('list');
                Route::put('/mark-as-shipped', MarkAsShippedController::class)->name('mark-as-shipped');
                Route::put('/cancel', CancelOrderController::class)->name('cancel');
            });
        })->middleware( 'role:admin');

        // Routes for User.
        Route::middleware('role:user')->group(function () {
            Route::group(['prefix' => 'products', 'as' => 'products.'], static function () {
                Route::get('/', ListProductController::class)->name('user.list');
            });

            Route::group(['prefix' => 'orders', 'as' => 'orders.'], static function () {
                Route::post('/', CreateOrderController::class)->name('create');
                Route::put('/add-to-cart', AddToCartController::class)->name('add-to-cart');
                Route::post('/checkout', CheckoutController::class)->name('checkout');
            });
        });
    });
});
