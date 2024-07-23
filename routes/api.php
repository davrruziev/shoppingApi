<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ChangeStatusOrderController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentCardTypeController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserPaymentCardController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::apiResources([
    'categories' => CategoryController::class,
    'products' => ProductController::class,
    'categories.products' => CategoryProductController::class,
    'favorites' => FavoriteController::class,
    'orders' => OrderController::class,
    'statuses' => StatusController::class,
    'statuses.orders' => ChangeStatusOrderController::class,
    'delivery-methods' => DeliveryMethodController::class,
    'payment-types' => PaymentTypeController::class,
    'user-address' => UserAddressController::class,
    'reviews' => ReviewController::class,
    'products.reviews' => ProductReviewController::class,
    'settings' => SettingController::class,
    'user-settings' => UserSettingController::class,
    'payment-card-types' => PaymentCardTypeController::class,
    'user-payment-cards' => UserPaymentCardController::class,
]);
