<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ReviewController;

use App\Http\Controllers\Technician\TechnicianDashboardController;
use App\Http\Controllers\Technician\TechnicianBookingController;
use App\Http\Controllers\Technician\TechnicianScheduleController;
use App\Http\Controllers\Technician\TechnicianServiceController;
use App\Http\Controllers\Technician\TechnicianReviewController;
use App\Http\Controllers\Technician\TechnicianProfileController;

use App\Http\Controllers\Client\ClientHomeController;  
use App\Http\Controllers\Client\ClientBookingController;
use App\Http\Controllers\Client\ClientReviewController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\ClientServiceController;





Route::get('/', function () {
    return view('welcome');
});


// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//? Admin Section

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // users management (resource)
    Route::resource('users', UserController::class);

    // technicians
    Route::resource('technicians', TechnicianController::class)
    ->only(['index' , 'show' , 'edit' , 'update']);


    // Technician Services Management
    Route::get('/technicians/{id}/services', [TechnicianController::class, 'services'])
        ->name('technicians.services');

    Route::post('/technicians/{id}/services', [TechnicianController::class, 'attachService'])
        ->name('technicians.services.attach');

    Route::delete('/technicians/{id}/services/{serviceId}', [TechnicianController::class, 'detachService'])
        ->name('technicians.services.detach');


    // Technician Schedule
    Route::get('/technicians/{id}/schedule', [TechnicianController::class, 'schedule'])
        ->name('technicians.schedule');

    Route::post('/technicians/{id}/schedule', [TechnicianController::class, 'addSchedule'])
    ->name('technicians.schedule.add');    


    // Technician Reviews
    Route::get('/technicians/{id}/reviews', [TechnicianController::class, 'reviews'])
        ->name('technicians.reviews');

    // Technician Delete
    Route::delete('/technicians/{id}', [TechnicianController::class, 'destroy'])
        ->name('technicians.destroy');

    
    // Services
    Route::resource('services', ServiceController::class);  

      
    // Categories Management
    Route::resource('categories', CategoryController::class);


    // bookings
    Route::resource('bookings', BookingController::class)
        ->except(['create', 'store']); 


    // Reviews Management
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/{id}', [ReviewController::class, 'show'])->name('show');
        Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');
    });
    
    
});






//? Technician Section

Route::middleware(['auth', 'technician'])
    ->prefix('technician')->name('technician.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [TechnicianDashboardController::class, 'index'])
        ->name('dashboard');

    // My Bookings
    Route::resource('bookings', TechnicianBookingController::class)
        ->only(['index','show']);

    Route::post('bookings/{id}/status', 
        [TechnicianBookingController::class, 'updateStatus'])
        ->name('bookings.updateStatus');

    // My Services
    Route::resource('services', TechnicianServiceController::class)
        ->only(['index' , 'update']);

    // My Schedule
    Route::resource('schedule', TechnicianScheduleController::class)
        ->only(['index','store','destroy']);

    Route::post('schedule/{id}/confirm', [TechnicianScheduleController::class, 'confirm'])
        ->name('schedule.confirm');

   // My Reviews
    Route::resource('reviews', TechnicianReviewController::class)
        ->only(['index']);

    // Profile
    Route::get('profile', [TechnicianProfileController::class, 'show'])
    ->name('profile.show');
    Route::put('profile', [TechnicianProfileController::class, 'update'])
    ->name('profile.update');
});





// CLIENT ROUTES
Route::middleware(['auth', 'client'])
    ->prefix('client')->name('client.')
    ->group(function () {

    // الصفحة الرئيسية
    Route::get('/home', [ClientHomeController::class, 'index'])->name('home');

    // الخدمات (عرض قائمة جميع الخدمات)
    Route::get('/services', [ClientServiceController::class, 'index'])->name('services');

    // عرض خدمة واحدة وتفاصيل الفنيين المختصين بها
    Route::get('/services/{id}', [ClientServiceController::class, 'show'])->name('services.show');

    // الحجوزات
    Route::resource('bookings', ClientBookingController::class)
        ->only(['index', 'create', 'store', 'show']);

    // الملف الشخصي
    Route::get('/profile', [ClientProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [ClientProfileController::class, 'update'])->name('profile.update');
});


