<?php
// FILE: routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\{
    AuthController, DashboardController, ProfileController,
    ProjectController, SkillController, CertificateController,
    ExperienceController, EducationController, TestimonialController,
    BlogController, MessageController, SettingController
};

// =============================================
// FRONTEND ROUTES
// =============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [HomeController::class, 'blogShow'])->name('blog.show');


// =============================================
// ADMIN AUTH ROUTES
// =============================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Auth required
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Projects
        Route::resource('projects', ProjectController::class);

        // Skills
        Route::resource('skills', SkillController::class);

        // Certificates
        Route::resource('certificates', CertificateController::class);

        // Experience
        Route::resource('experience', ExperienceController::class);

        // Education
       Route::resource('education', EducationController::class);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Blogs
        Route::resource('blogs', BlogController::class);

        // Messages
        Route::get('/messages',           [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{contact}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{contact}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Settings
        Route::get('/settings',  [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });

    
});