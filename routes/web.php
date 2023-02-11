<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardTiketController;
use App\Http\Controllers\DashboardReviewsController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardAccountUserController;
use App\Http\Controllers\DashboardHotelController;
use App\Http\Controllers\DashboardOrderanUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect('/login'); 
});

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

// Data Tiket admin
Route::resource('data_tiket', DashboardTiketController::class)->middleware('admin');
Route::get('/dashboard/tiket/provinsi/{id}', [DashboardTiketController::class, 'get_kota'])->middleware('admin');
// Data Categories admin
Route::resource('data_categories', DashboardCategoryController::class)->middleware('admin');
Route::get('/dashboard/categories/slug', [DashboardCategoryController::class, 'slug'])->middleware('admin');
// Data Account admin
Route::resource('data_account', DashboardAccountUserController::class)->middleware('admin');
// Data Reviews admin
Route::resource('data_reviews', DashboardReviewsController::class)->middleware('admin');
// Data Orders admin
Route::resource('data_orders', DashboardOrderanUserController::class)->middleware('admin');
// Data Hotel Admin
Route::resource('data_hotel', DashboardHotelController::class)->middleware('admin');
Route::get('/dashboard/hotel/slug', [DashboardHotelController::class, 'slug'])->middleware('admin');
// Route Admin Profile
Route::get('/dashboard/admin/edit/{id}', [DashboardController::class, 'editProfile'])->name('dashboard.editProfile')->middleware('admin');
Route::put('/dashboard/admin/profile/update/{users:id}', [DashboardController::class, 'updateProfile'])->name('dashboard.updateProfile')->middleware('admin');

// Route halaman frontend
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/about', [AboutController::class, 'index'])->middleware('auth');
Route::get('/categories', [CategoriesController::class, 'index'])->middleware('auth');
Route::get('/shop', [ShopController::class, 'index'])->middleware('auth');

// Route auth & register
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/process', [LoginController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register/process', [RegisterController::class, 'process'])->name('register.process');