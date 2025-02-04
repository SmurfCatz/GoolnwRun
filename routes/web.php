<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Organizer\LoginOrganizerController;
use App\Http\Controllers\Organizer\OrganizerAuthController;
use App\Http\Controllers\Auth\OrganizerRegisterController;
use App\Http\Controllers\Auth\OrganizerLoginController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


        Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
        Route::put('/address/{id}', [AddressController::class, 'updateAddress'])->name('address.update');
        Route::delete('/address/{id}', [AddressController::class, 'deleteAddress'])->name('address.delete');

        // Route::prefix('events')->group(function () {
        //     Route::get('/', [EventController::class, 'index'])->name('organizer.events.index');
        //     Route::get('/create', [EventController::class, 'create'])->name('organizer.events.create');
        //     Route::post('/', [EventController::class, 'store'])->name('organizer.events.store');
        //     Route::get('/{event}/edit', [EventController::class, 'edit'])->name('organizer.edit');
        //     Route::put('/{event}', [EventController::class, 'update'])->name('organizer.events.update');
        //     Route::delete('/{event}', [EventController::class, 'destroy'])->name('organizer.events.destroy');
        // });
    });
});




Route::get('/organizer/login', [OrganizerLoginController::class, 'showLoginForm'])->name('auth.organizer_login');
Route::post('/organizer/login', [OrganizerLoginController::class, 'login'])->name('organizer.login');
Route::post('/organizer/logout', [OrganizerLoginController::class, 'logout'])->name('organizer.logout');
Route::post('/organizer/register', [OrganizerRegisterController::class, 'register'])->name('organizer.register');
Route::get('/organizer/register', [OrganizerRegisterController::class, 'showOrganizerForm'])->name('auth.organizer_register');
Route::get('/organizer/home', [HomeController::class, 'organizerHome'])->name('organizer.home')->middleware('auth:organizer');

// Routes for admin users
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/members', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/members/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/members', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/members/{members}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/members/{members}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/members/{members}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/members/{members}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Routes for organizer users
// Route::get('/organizer/home', [HomeController::class, 'organizerHome'])->name('organizer.home')->middleware('organizer');

// Route::get('/register/organizer', [App\Http\Controllers\Auth\RegisterController::class, 'showOrganizerForm'])->name('register.organizer');
// Route::post('/register/organizer', [App\Http\Controllers\Auth\RegisterController::class, 'registerOrganizer'])->name('register.organizer.store');
