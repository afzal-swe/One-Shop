<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Backend Controller Section //
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SeoController;
use App\Http\Controllers\Backend\SmtpController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\WebsiteSettingController;
use App\Http\Controllers\Backend\WarehouseController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\Pickup_pointController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CampaignController;



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
Route::get('/password/change', [AdminController::class, 'change_password'])->middleware(['auth', 'verified'])->name('password.change');
Route::post('/password/update', [AdminController::class, 'password_update'])->middleware(['auth', 'verified'])->name('pass.update');


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

// Social Route Section Start ===========================================================
Route::get('/social/setting', [SocialController::class, 'create'])->name('social.create')->middleware(['auth', 'verified']);
Route::post('/social/store', [SocialController::class, 'store'])->name('social.store')->middleware(['auth', 'verified']);
Route::post('/social/update/{id}', [SocialController::class, 'update'])->name('social.update')->middleware(['auth', 'verified']);


// SMTP Route Section Start ===========================================================
Route::get('/smtp/setting', [SmtpController::class, 'create'])->name('smtp.create')->middleware(['auth', 'verified']);
Route::post('/smtp/store', [SmtpController::class, 'store'])->name('smtp.store')->middleware(['auth', 'verified']);
Route::post('/smtp/update/{id}', [SmtpController::class, 'update'])->name('smtp.update')->middleware(['auth', 'verified']);

// Page Management Route Section Start ===========================================================
Route::get('/page/management', [PageController::class, 'index'])->name('page.index')->middleware(['auth', 'verified']);
Route::get('/page/create', [PageController::class, 'create'])->name('page.create')->middleware(['auth', 'verified']);
Route::post('/page/store', [PageController::class, 'store'])->name('page.store')->middleware(['auth', 'verified']);
Route::get('/page/edit/{id}', [PageController::class, 'edit'])->name('page.edit')->middleware(['auth', 'verified']);
Route::post('/page/update/{id}', [PageController::class, 'update'])->name('page.update')->middleware(['auth', 'verified']);
Route::get('/page/delete/{id}', [PageController::class, 'destroy'])->name('page.destroy')->middleware(['auth', 'verified']);


// Web Site Setting Route Section Start ===========================================================
Route::get('/website/info', [WebsiteSettingController::class, 'create'])->name('website.setting.create')->middleware(['auth', 'verified']);
Route::post('/website/info/store', [WebsiteSettingController::class, 'store'])->name('website.setting.store')->middleware(['auth', 'verified']);
Route::post('/website/info/update/{id}', [WebsiteSettingController::class, 'update'])->name('website.setting.update')->middleware(['auth', 'verified']);


// Ware House Route Section Start ===========================================================
Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse.index')->middleware(['auth', 'verified']);
Route::post('/warehouse/store', [WarehouseController::class, 'store'])->name('warehouse.store')->middleware(['auth', 'verified']);
Route::get('/warehouse/delete/{id}', [WarehouseController::class, 'delete'])->name('warehouse.delete')->middleware(['auth', 'verified']);


// Coupon Route Section Start ===========================================================
Route::get('/coupon', [CouponController::class, 'index'])->name('coupon.index')->middleware(['auth', 'verified']);
Route::post('/coupon/store', [CouponController::class, 'store'])->name('coupon.store')->middleware(['auth', 'verified']);
Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit')->middleware(['auth', 'verified']);
Route::get('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy')->middleware(['auth', 'verified']);


// Campaign Route Section Start ===========================================================
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index')->middleware(['auth', 'verified']);
Route::post('/campaign/store', [CampaignController::class, 'store'])->name('campaign.store')->middleware(['auth', 'verified']);
// Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit')->middleware(['auth', 'verified']);
// Route::get('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy')->middleware(['auth', 'verified']);

// Pickup Point Route Section Start ===========================================================
Route::get('/pickup', [Pickup_pointController::class, 'index'])->name('pickup_point.index')->middleware(['auth', 'verified']);
Route::post('/pickup/store', [Pickup_pointController::class, 'store'])->name('pickup_point.store')->middleware(['auth', 'verified']);
Route::get('/pickup/delete/{id}', [Pickup_pointController::class, 'destroy'])->name('pickup_point.delete')->middleware(['auth', 'verified']);

// Pickup Point Route Section Start ===========================================================
Route::get('/all/products', [ProductController::class, 'index'])->name('product.index')->middleware(['auth', 'verified']);
Route::get('/add/product', [ProductController::class, 'create'])->name('product.create')->middleware(['auth', 'verified']);
Route::post('/store/product', [ProductController::class, 'store'])->name('product.store')->middleware(['auth', 'verified']);



// require __DIR__ . '/auth.php';
