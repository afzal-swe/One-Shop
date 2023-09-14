<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Controller
use App\Http\Controllers\Frontend\F_CategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ReviewController;

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

Route::get('/', function () {
    return view('frontend.layouts.main');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin/login', [AdminController::class, 'supper_admin'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/product/category', [F_CategoryController::class, 'index'])->name('product.index');

// Index Controller route
Route::get('/product/details/{slug}', [IndexController::class, 'index'])->name('product.details');


// Reviews Controller route
Route::post('/review/store', [ReviewController::class, 'store'])->name('store.review');
// Wishlist route section
Route::get('/wishlist/store/{id}', [ReviewController::class, 'store_wishlist'])->name('add.wishlist')->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
