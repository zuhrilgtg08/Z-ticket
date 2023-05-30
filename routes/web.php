<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardHotelController;
use App\Http\Controllers\Dashboard\DashboardTiketController;
use App\Http\Controllers\Dashboard\DashboardReviewsController;
use App\Http\Controllers\Dashboard\DashboardCategoryController;
use App\Http\Controllers\Dashboard\DashboardAccountUserController;
use App\Http\Controllers\Dashboard\DashboardOrderanUserController;

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
    return redirect('/home'); 
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
Route::put('/dashboard/admin/password/change/{users:id}', [DashboardController::class, 'changePassword'])->name('dashboard.changePassword')->middleware('admin');
// Route halaman frontend
Route::get('/about', [AboutController::class, 'index']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/explore', [ExploreController::class, 'index']);
Route::get('/explore/detail/{hotel:id}', [ExploreController::class, 'detail'])->name('explore.detail')->middleware('auth');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/tiket/data/detail/{tiket:id}', [HomeController::class, 'detail'])->name('homeTiket.detail')->middleware('auth');
Route::get('/home/tiket/hotel/detail/{hotel:id}', [HomeController::class, 'detail_hotel'])->name('homeHotel.detail')->middleware('auth');
Route::post('/home/hotel/reviews', [HomeController::class, 'reviewHotel'])->name('review.hotel')->middleware('auth');

// Route halaman edit porfile frontend
Route::get('/edit/profile/{users:id}', [UsersController::class, 'edit'])->name('edit.profile')->middleware('auth');
Route::put('/edit/profile/{users:id}/proses/update', [UsersController::class, 'update'])->name('update.profile')->middleware('auth');

// Route auth & register
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/process', [LoginController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register/process', [RegisterController::class, 'process'])->name('register.process');