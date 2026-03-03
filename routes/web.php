<?php

use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hotels\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/dashboard', [HomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/services', [HomeController::class,'services'])->name('services');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
Route::get('/', [HomeController::class,'index'])->name('index');

//hotels
Route::get('/hotels/rooms/{id}', [HotelController::class, 'rooms'])->name('hotels.rooms');
Route::get('/hotels/rooms-details/{id}', [HotelController::class, 'roomsDetails'])->name('hotels.rooms.details');
Route::post('/hotels/rooms-booking/{id}', [HotelController::class, 'roomsBooking'])->name('hotels.rooms.booking');

//pay
Route::get('/booking/{id}/payment', [HotelController::class, 'show'])->name('booking.payment');
Route::post('/booking/{id}/pay', [HotelController::class, 'pay'])->name('booking.pay');
Route::get('/booking/{id}/success', [HotelController::class, 'success'])->name('booking.success');

//users
Route::get('/users/my-bookings', [UsersController::class, 'myBookings'])->name('users.bookings')->middleware('auth:web');

//admin panel
Route::get('/admin/login',[AdminsController::class,'ViewLogin'])->name('view.login')->middleware('check.for.login');
Route::post('/admin/login',[AdminsController::class,'checkLogin'])->name('check.login');
Route::get('/admin/logout',[AdminsController::class,'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {
    Route::get('/index',[AdminsController::class,'index'])->name('admins.dashboard');

//admins
    Route::get('/all-admins',[AdminsController::class,'allAdmins'])->name('admins.all');
    Route::get('/create-admins',[AdminsController::class,'createAdmins'])->name('admins.create');
    Route::post('/store-admins',[AdminsController::class,'storeAdmins'])->name('admins.store');
//hotels
    Route::get('/all-hotels',[AdminsController::class,'allHotels'])->name('admin.hotels.all');
    Route::get('/create-hotels',[AdminsController::class,'createHotels'])->name('admin.hotels.create');
    Route::post('/store-hotels',[AdminsController::class,'storeHotels'])->name('admin.hotels.store');
    Route::get('/edit-hotels/{id}',[AdminsController::class,'editHotels'])->name('admin.hotels.edit');
    Route::put('/update-hotels/{id}',[AdminsController::class,'updateHotels'])->name('admin.hotels.update');
    Route::get('/delete-hotels/{id}',[AdminsController::class,'deleteHotels'])->name('admin.hotels.delete');
    //rooms
    Route::get('/all-rooms',[AdminsController::class,'allRooms'])->name('admin.rooms.all');
    Route::get('/create-rooms',[AdminsController::class,'createRooms'])->name('admin.rooms.create');
    Route::post('/store-rooms',[AdminsController::class,'storeRooms'])->name('admin.rooms.store');
    Route::get('/delete-rooms/{id}',[AdminsController::class,'deleteRooms'])->name('admin.rooms.delete');
    //bookings
    Route::get('/all-bookings',[AdminsController::class,'allBookings'])->name('admin.bookings.all');
    Route::get('/edit-bookings/{id}',[AdminsController::class,'editBookings'])->name('admin.bookings.edit');
    Route::put('/update-bookings/{id}',[AdminsController::class,'updateBookings'])->name('admin.bookings.update');
    Route::get('/delete-bookings/{id}',[AdminsController::class,'deleteBookings'])->name('admin.bookings.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
