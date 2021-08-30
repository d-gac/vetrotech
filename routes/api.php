<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KontrahentController;
use App\Http\Controllers\LexiconController;
use App\Http\Controllers\ZamowienieController;

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


    //Produkt
    Route::prefix('product')->group(function () {
        Route::get('/allProduct', [ProductController::class, 'allProduct']);
        Route::get('/deleted', [ProductController::class, 'deleted']);
        Route::get('/renew/{id}', [ProductController::class, 'renew']);
        Route::apiResource('/', ProductController::class);
    });


    //Kontrahent
    Route::prefix('kontrahent')->group(function () {
        Route::get('/allContractor', [KontrahentController::class, 'allContractor']);
        Route::get('/deleted', [KontrahentController::class, 'deleted']);
        Route::get('/renew/{id}', [KontrahentController::class, 'renew']);
        Route::apiResource('/', KontrahentController::class);
    });


    //Zamówienie
    Route::prefix('zamowienie')->group(function () {
        Route::get('/allOrder', [ZamowienieController::class, 'allOrder']);
        Route::get('/deleted', [ZamowienieController::class, 'deleted']);
        Route::get('/renew/{id}', [ZamowienieController::class, 'renew']);
        Route::apiResource('/', ZamowienieController::class);
    });


    //Słownik
    Route::get('/lexicon/{type}/{id?}', [LexiconController::class, 'lexicon']);


    //Wylogowanie
    Route::post('/logout', [UserController::class, 'logout']);

});












Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
