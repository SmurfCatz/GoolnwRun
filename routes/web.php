<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\OrganizerRegisterController;
use App\Http\Controllers\Auth\OrganizerLoginController;
use App\Http\Controllers\Organizer\OrganizerProfileController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SubEventController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/remove-image', [ProfileController::class, 'removeImage'])->name('profile.removeImage');

        Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
        Route::put('/address/{id}', [AddressController::class, 'updateAddress'])->name('address.update');
        Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('address.delete');
    });
});

// Organizer Routes
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

    Route::get('/organizer/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::get('/organizer/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('/organizer/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/organizer/events/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/organizer/events/{id}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('/organizer/events/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');

    Route::get('/organizer/events/{eventId}/sub-events', [SubEventController::class, 'index'])->name('admin.events.subEvents.index');
    Route::get('/organizer/events/{eventId}/sub-events/create', [SubEventController::class, 'create'])->name('admin.events.subEvents.create');
    Route::post('/organizer/events/{eventId}/sub-events', [SubEventController::class, 'store'])->name('admin.events.subEvents.store');
    Route::get('/organizer/events/{eventId}/sub-events/{subEventId}/edit', [SubEventController::class, 'edit'])->name('admin.events.subEvents.edit');
    Route::put('/organizer/events/{eventId}/sub-events/{subEventId}', [SubEventController::class, 'update'])->name('admin.events.subEvents.update');
    Route::delete('/organizer/events/{eventId}/sub-events/{subEventId}', [SubEventController::class, 'destroy'])->name('admin.events.subEvents.destroy');

    Route::get('admin/events/create/step1', [EventController::class, 'createStep1'])->name('admin.events.create.step1');
    Route::post('admin/events/create/step1', [EventController::class, 'storeStep1']);
    Route::get('admin/events/create/step2', [EventController::class, 'createStep2'])->name('admin.events.create.step2');
    Route::post('admin/events/create/step2', [EventController::class, 'storeStep2']);
});

Route::get('/change-language/{lang}', function ($lang, Request $request) {
    Session::put('locale', $lang); // บันทึกภาษาไว้ใน session
    App::setLocale($lang);        // ตั้งค่าภาษาใหม่ใน runtime

    return redirect()->back();    // กลับไปหน้าที่แล้ว
})->name('change.language');
