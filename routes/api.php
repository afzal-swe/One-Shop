<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BrandApiController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/{id?}', [UserController::class, 'showUser']); // id ? = ? means optional , we are show single user or multi user showing. (get/fetch)

// Brand Route Section Start ==============================================================
Route::get('/brands/{id?}', [BrandApiController::class, 'index']);
Route::post('/add/brand', [BrandApiController::class, 'store']);
// Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
// Route::post('/brand/update/{id}', [BrandController::class, 'update']);
// Route::get('/brand/delete/{id}', [BrandController::class, 'destroy']);
