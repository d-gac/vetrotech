<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KontrahentController;
use App\Http\Controllers\LexiconController;

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
    Route::get('product/allProduct', [ProductController::class, 'allProduct']);
    Route::get('product/deleted', [ProductController::class, 'deleted']);
    Route::get('product/renew/{id}', [ProductController::class, 'renew']);
    Route::apiResource('/product', ProductController::class);


    //Kontrahent
    Route::get('kontrahent/allContractor', [KontrahentController::class, 'allContractor']);
    Route::get('kontrahent/deleted', [KontrahentController::class, 'deleted']);
    Route::get('kontrahent/renew/{id}', [KontrahentController::class, 'renew']);
    Route::apiResource('/kontrahent', KontrahentController::class);


    //Słownik
    Route::get('/lexicon/allDimensions', [LexiconController::class, 'allDimensions']);
    Route::get('/lexicon/allTypeOfGlass', [LexiconController::class, 'allTypeOfGlass']);
    Route::get('/lexicon/allNameOfGlass', [LexiconController::class, 'allNameOfGlass']);
    Route::get('/lexicon/allNumberDepartment', [LexiconController::class, 'allNumberDepartment']);
    Route::get('/lexicon/allDimensions/{id}', [LexiconController::class, 'oneDimensions']);
    Route::get('/lexicon/allTypeOfGlass/{id}', [LexiconController::class, 'oneTypeOfGlass']);
    Route::get('/lexicon/allNameOfGlass/{id}', [LexiconController::class, 'oneNameOfGlass']);
    Route::get('/lexicon/allNumberDepartment/{id}', [LexiconController::class, 'oneNumberDepartment']);


    //Wylogowanie
    Route::post('/logout', [UserController::class, 'logout']);

});












Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
