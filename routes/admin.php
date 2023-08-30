<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Backend Controller Section //
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SeoController;



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

// Brand Route Section Start ==============================================================
Route::get('/all/brands', [BrandController::class, 'index'])->name('brand.index')->middleware(['auth', 'verified']);
Route::post('/add/brand', [BrandController::class, 'store'])->name('brand.store')->middleware(['auth', 'verified']);
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit')->middleware(['auth', 'verified']);
Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update')->middleware(['auth', 'verified']);
Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.destroy')->middleware(['auth', 'verified']);


// Category Route Section Start ===========================================================
Route::get('/all/category', [CategoryController::class, 'index'])->name('category.index')->middleware(['auth', 'verified']);
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store')->middleware(['auth', 'verified']);
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware(['auth', 'verified']);
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware(['auth', 'verified']);
Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware(['auth', 'verified']);


// Sub Category Route Section Start ===========================================================
Route::get('/all/sub-category', [SubCategoryController::class, 'index'])->name('subcategory.index')->middleware(['auth', 'verified']);
Route::post('/add/sub-category', [SubCategoryController::class, 'store'])->name('subcategory.store')->middleware(['auth', 'verified']);
Route::get('/edit/sub-category/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit')->middleware(['auth', 'verified']);
Route::post('/update/sub-category/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update')->middleware(['auth', 'verified']);
Route::get('/sub-category/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy')->middleware(['auth', 'verified']);


// SEO Route Section Start ===========================================================
Route::get('/seo', [SeoController::class, 'create'])->name('seo.create')->middleware(['auth', 'verified']);
Route::post('/seo/store', [SeoController::class, 'store'])->name('seo.store')->middleware(['auth', 'verified']);
Route::post('/seo/update/{id}', [SeoController::class, 'update'])->name('seo.update')->middleware(['auth', 'verified']);

// require __DIR__ . '/auth.php';
