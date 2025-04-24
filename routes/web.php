<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\OrganizerRegisterController;
use App\Http\Controllers\Auth\OrganizerLoginController;
use App\Http\Controllers\Organizer\OrganizerProfileController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Organizer\EventController;



Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/remove-image', [ProfileController::class, 'removeImage'])->name('profile.removeImage');
        

        Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
        Route::put('/address/{id}', [AddressController::class, 'updateAddress'])->name('address.update');
        Route::delete('/address/{id}', [AddressController::class, 'deleteAddress'])->name('address.delete');
    });
});

Route::middleware('auth:organizer')->group(function () {
    Route::get('/organizer/edit', [OrganizerProfileController::class, 'edit'])->name('organizer.profile.edit');
    Route::put('organizer/profile/update', [OrganizerProfileController::class, 'update'])->name('organizer.profile.update');
});

Route::get('/organizer/login', [OrganizerLoginController::class, 'showLoginForm'])->name('auth.organizer_login');
Route::post('/organizer/login', [OrganizerLoginController::class, 'login'])->name('organizer.login');
Route::post('/organizer/logout', [OrganizerLoginController::class, 'logout'])->name('organizer.logout');
Route::post('/organizer/register', [OrganizerRegisterController::class, 'register'])->name('organizer.register');
Route::get('/organizer/register', [OrganizerRegisterController::class, 'showOrganizerForm'])->name('auth.organizer_register');
Route::get('/organizer/home', [HomeController::class, 'organizerHome'])->name('organizer.home')->middleware('auth:organizer');

Route::middleware('auth:organizer')->get('/check-approval', [OrganizerController::class, 'checkApproval'])->name('admin.check.approval');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/organizers', [OrganizerController::class, 'index'])->name('admin.organizers.index');
    Route::get('/organizers/create', [OrganizerController::class, 'create'])->name('admin.organizers.create');
    Route::post('/organizers', [OrganizerController::class, 'store'])->name('admin.organizers.store');
    Route::get('/organizers/{organizers}', [OrganizerController::class, 'show'])->name('admin.organizers.show');
    Route::get('/organizers/{organizers}/edit', [OrganizerController::class, 'edit'])->name('admin.organizers.edit');
    Route::put('/organizers/{organizers}', [OrganizerController::class, 'update'])->name('admin.organizers.update');
    Route::delete('/organizers/{organizers}', [OrganizerController::class, 'destroy'])->name('admin.organizers.destroy');

    Route::get('/admin/organizers/pending', [OrganizerController::class, 'pendingOrganizers'])->name('admin.organizers.pending');
    Route::post('/organizers/approve/{id}', [OrganizerController::class, 'approve'])->name('admin.organizers.approve');
    Route::get('/organizer/loading', function () {
        return view('organizer.loading');
    })->name('organizer.loading');


    Route::get('/members', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/members/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/members', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/members/{members}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/members/{members}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/members/{members}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/members/{members}', [UserController::class, 'destroy'])->name('admin.users.destroy');



    Route::get('/packages', [PackageController::class, 'index'])->name('admin.packages.index');
    Route::get('/packages/create', [PackageController::class, 'create'])->name('admin.packages.create');
    Route::post('/packages', [PackageController::class, 'store'])->name('admin.packages.store');
    Route::get('/packages/{id}/edit', [PackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('/packages/{id}', [PackageController::class, 'update'])->name('admin.packages.update');
    Route::delete('/packages/{id}', [PackageController::class, 'destroy'])->name('admin.packages.destroy');
});
Route::middleware(['auth:web,organizer'])->group(function () {
    Route::get('/organizer/events', [EventController::class, 'index'])->name('organizer.events.index');
    Route::get('/organizer/events/create', [EventController::class, 'create'])->name('organizer.events.create');
    Route::post('/organizer/events', [EventController::class, 'store'])->name('organizer.events.store');
    Route::get('/organizer/events/{id}', [EventController::class, 'show'])->name('organizer.events.show');
    Route::get('/organizer/events/{id}/edit', [EventController::class, 'edit'])->name('organizer.events.edit');
    Route::put('/organizer/events/{id}', [EventController::class, 'update'])->name('organizer.events.update');
    Route::delete('/organizer/events/{id}', [EventController::class, 'destroy'])->name('organizer.events.destroy');
});
Route::post('/organizer/events/setPackage', [EventController::class, 'setPackage'])->name('organizer.events.setPackage');
