<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\OrganizerRegisterController;
use App\Http\Controllers\Auth\OrganizerLoginController;
use App\Http\Controllers\Organizer\OrganizerProfileController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Organizer\EventController;

// =========================
// Home Route
// =========================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// =========================
// Auth Routes for Users (Web Guard)
// =========================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// =========================
// Profile and Address Management for Users
// =========================
Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/remove-image', [ProfileController::class, 'removeImage'])->name('profile.removeImage');

    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
    Route::put('/address/{id}', [AddressController::class, 'updateAddress'])->name('address.update');
    Route::delete('/address/{id}', [AddressController::class, 'deleteAddress'])->name('address.delete');
});

// =========================
// Organizer Authentication Routes
// =========================
Route::get('/organizer/login', [OrganizerLoginController::class, 'showLoginForm'])->name('auth.organizer_login');
Route::post('/organizer/login', [OrganizerLoginController::class, 'login'])->name('organizer.login');
Route::post('/organizer/logout', [OrganizerLoginController::class, 'logout'])->name('organizer.logout');

Route::get('/organizer/register', [OrganizerRegisterController::class, 'showOrganizerForm'])->name('auth.organizer_register');
Route::post('/organizer/register', [OrganizerRegisterController::class, 'register'])->name('organizer.register');

Route::get('/organizer/home', [HomeController::class, 'organizerHome'])->name('organizer.home')->middleware('auth:organizer');

// =========================
// Organizer Profile Management
// =========================
Route::middleware('auth:organizer')->group(function () {
    Route::get('/organizer/edit', [OrganizerProfileController::class, 'edit'])->name('organizer.profile.edit');
    Route::put('/organizer/profile/update', [OrganizerProfileController::class, 'update'])->name('organizer.profile.update');
    Route::get('/check-approval', [OrganizerController::class, 'checkApproval'])->name('admin.check.approval');
});

// =========================
// Admin Routes (Manage Organizers, Members, Packages)
// =========================
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');

    // Organizer Management
    Route::resource('organizers', OrganizerController::class, ['as' => 'admin.organizers'])->except(['edit', 'update', 'destroy']);
    Route::get('/organizers/{organizer}/edit', [OrganizerController::class, 'edit'])->name('admin.organizers.edit');
    Route::put('/organizers/{organizer}', [OrganizerController::class, 'update'])->name('admin.organizers.update');
    Route::delete('/organizers/{organizer}', [OrganizerController::class, 'destroy'])->name('admin.organizers.destroy');
    Route::get('/organizers/pending', [OrganizerController::class, 'pendingOrganizers'])->name('admin.organizers.pending');
    Route::post('/organizers/approve/{id}', [OrganizerController::class, 'approve'])->name('admin.organizers.approve');

    // Member Management
    Route::resource('members', UserController::class, ['as' => 'admin.users']);

    // Package Management
    Route::resource('packages', PackageController::class, ['as' => 'admin.packages']);
});

// =========================
// Organizer Events Management
// =========================
Route::middleware('auth:web,organizer')->group(function () {
    Route::resource('organizer/events', EventController::class, ['as' => 'organizer.events']);
});

Route::post('/organizer/events/setPackage', [EventController::class, 'setPackage'])->name('organizer.events.setPackage');
