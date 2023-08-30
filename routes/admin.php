<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Backend Controller Section //
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/login', [AdminController::class, 'supper_admin'])->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/brands', [BrandController::class, 'index'])->name('brand.index')->middleware(['auth', 'verified']);
Route::post('/add/brand', [BrandController::class, 'store'])->name('brand.store')->middleware(['auth', 'verified']);
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit')->middleware(['auth', 'verified']);
Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update')->middleware(['auth', 'verified']);
Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.destroy')->middleware(['auth', 'verified']);

// require __DIR__ . '/auth.php';
