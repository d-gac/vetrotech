<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

// Publiczne
Route::post('register', [UserController::class, 'register']);
Route::post("login", [UserController::class, 'login']);


// Autoryzowane
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('product/allProduct', [ProductController::class, 'allProduct']);
    Route::get('product/deleted', [ProductController::class, 'deleted']);
    Route::get('product/renew/{id}', [ProductController::class, 'renew']);
    Route::apiResource('/product', ProductController::class);
    Route::post('/logout', [UserController::class, 'logout']);

});












Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
