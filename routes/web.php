<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home\HomeSlideController;
use App\Http\Controllers\aboutController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout','destroy')->name('adminLogout');
    Route::get('/admin/profile','profile')->name('adminProfile');
    Route::get('/admin/profile/edit','editProfile')->name('editProfile');
    Route::post('/store/profile','storeProfile')->name('store.profile');

    Route::get('/change/password','changePassword')->name('changePassword');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

Route::controller(HomeSlideController::class)->group(function(){
    Route::get('/home/slide','homeSlide')->name('homeSlide');
    Route::post('/update/slide','UpdateSlider')->name('update.slider');

});

Route::controller(aboutController::class)->group(function(){
    Route::get('/about/page','AboutPage')->name('aboutpage');
    Route::post('/update/aboutPage','UpdateAbout')->name('update.about');
    Route::get('/about','HomeAbout')->name('home.about');
    

});


require __DIR__.'/auth.php';
