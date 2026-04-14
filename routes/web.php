<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DoctorManagementController;
use App\Http\Controllers\Admin\PatientManagementController;
use App\Http\Controllers\Admin\ContactManagementController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\SpecializationManagementController;
use App\Http\Controllers\Auth\DoctorRegisterController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Patient\AppointmentBookingController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('lang.switch');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/specialties', [HomeController::class, 'allSpecialties'])->name('specialties.all');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/specialty/{id}', [HomeController::class, 'specialty'])->name('specialty.show');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/doctors', [PatientController::class, 'doctors'])->name('patient.doctors');
Route::get('/health-advice', [HomeController::class, 'healthAdvice'])->name('health-advice');
Route::post('/ai/chat', [\App\Http\Controllers\AiChatController::class, 'chat'])->name('ai.chat');

// Doctor Registration Routes
Route::get('/doctor/register', [DoctorRegisterController::class, 'showRegistrationForm'])->name('doctor.register');
Route::post('/doctor/register', [DoctorRegisterController::class, 'register'])->name('doctor.register.submit');

// Dashboard with role-based redirect
Route::get('/dashboard', function () {
    /** @var User $user */
    $user = Auth::user();
    
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isDoctor()) {
        return redirect()->route('doctor.dashboard');
    } else {
        return redirect()->route('patient.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes - Protected by admin middleware
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Doctor Management
    Route::get('/doctors', [DoctorManagementController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [DoctorManagementController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorManagementController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{id}', [DoctorManagementController::class, 'show'])->name('doctors.show');
    Route::post('/doctors/{id}/approve', [DoctorManagementController::class, 'approve'])->name('doctors.approve');
    Route::post('/doctors/{id}/reject', [DoctorManagementController::class, 'reject'])->name('doctors.reject');
    Route::post('/doctors/{id}/suspend', [DoctorManagementController::class, 'suspend'])->name('doctors.suspend');
    Route::post('/doctors/{id}/activate', [DoctorManagementController::class, 'activate'])->name('doctors.activate');
    Route::delete('/doctors/{id}', [DoctorManagementController::class, 'destroy'])->name('doctors.destroy');
    
    // Patient Management
    Route::get('/patients', [PatientManagementController::class, 'index'])->name('patients.index');
    Route::get('/patients/{id}', [PatientManagementController::class, 'show'])->name('patients.show');
    Route::delete('/patients/{id}', [PatientManagementController::class, 'destroy'])->name('patients.destroy');
    
    // Contact Management
    Route::get('/contacts', [ContactManagementController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactManagementController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/{id}/mark-read', [ContactManagementController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::post('/contacts/{id}/mark-replied', [ContactManagementController::class, 'markAsReplied'])->name('contacts.mark-replied');
    Route::delete('/contacts/{id}', [ContactManagementController::class, 'destroy'])->name('contacts.destroy');

    // Admin Management
    Route::get('/admins', [AdminManagementController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminManagementController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminManagementController::class, 'store'])->name('admins.store');
    Route::delete('/admins/{id}', [AdminManagementController::class, 'destroy'])->name('admins.destroy');

    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Specializations
    Route::get('/specializations', [SpecializationManagementController::class, 'index'])->name('specializations.index');
    Route::get('/specializations/create', [SpecializationManagementController::class, 'create'])->name('specializations.create');
    Route::post('/specializations', [SpecializationManagementController::class, 'store'])->name('specializations.store');
    Route::get('/specializations/{id}/edit', [SpecializationManagementController::class, 'edit'])->name('specializations.edit');
    Route::patch('/specializations/{id}', [SpecializationManagementController::class, 'update'])->name('specializations.update');
    Route::delete('/specializations/{id}', [SpecializationManagementController::class, 'destroy'])->name('specializations.destroy');
});

// Doctor Routes - Protected by doctor middleware
Route::middleware(['auth', 'verified', 'doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    
    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::post('/appointments/{id}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
    Route::post('/appointments/{id}/complete', [AppointmentController::class, 'complete'])->name('appointments.complete');
    Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    
    // Schedules
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
    Route::post('/schedules/{id}/toggle', [ScheduleController::class, 'toggleAvailability'])->name('schedules.toggle');

    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Patient Routes - Protected by patient middleware
Route::middleware(['auth', 'verified'])->prefix('patient')->name('patient.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('dashboard');
    
    // View Doctors (Moved to public section)
    
    // Doctor Details & Booking
    Route::get('/doctors/{id}/details', [AppointmentBookingController::class, 'showDoctor'])->name('doctors.show');
    Route::get('/doctors/{id}/book', [AppointmentBookingController::class, 'bookingForm'])->name('doctors.book');
    Route::post('/appointments/book', [AppointmentBookingController::class, 'store'])->name('appointments.store');
    
    // View Appointment Details
    Route::get('/appointments/{id}', [PatientController::class, 'viewAppointment'])->name('appointments.show');
    
});

require __DIR__.'/auth.php';