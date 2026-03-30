<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Authentication routes
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Forgot password routes
    Route::controller(PasswordResetController::class)->group(function () {
        Route::get('/forgot-password', 'showForgotForm')->name('password.request');
        Route::post('/forgot-password', 'sendResetLink')->name('password.email');
        Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
        Route::post('/reset-password', 'resetPassword')->name('password.update');
    });
});


// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Email verification routes
    Route::controller(EmailVerificationController::class)->group(function () {
        Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['signed'])->name('verification.verify');
        Route::post('/email/verification-notification', 'send')->middleware(['throttle:6,1'])->name('verification.send');
    });    
    
    // Posts management routes
    Route::resource('posts', PostController::class)->except(['index', 'show']);
});

// Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/admin2/profile', 'show')->name('admin.profile.show');
        Route::patch('/admin2/profile', 'update')->name('admin.profile.update');
        Route::patch('/admin2/profile/password', 'updatePassword')->name('admin.profile.password');
    });

    // Category management routes
    Route::resource('categories', CategoryController::class)->except(['index', 'show']);

    // Admin dashboard and post review routes
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/posts/{post}/review', [AdminController::class, 'reviewPost'])->name('admin.review-post');
    Route::patch('/admin/posts/{post}/approve', [AdminController::class, 'approvePost'])->name('admin.approve-post');
    Route::patch('/admin/posts/{post}/reject', [AdminController::class, 'rejectPost'])->name('admin.reject-post');

    // Admin dashboard 2 management layananmu
    Route::get('/admin2', [AdminController::class, 'dashboard2View'])->name('admin.dashboard2');

    // Graduation (alumni) management routes
    Route::get('/admin2/graduation', [GraduationController::class, 'index'])->name('admin.graduation');
    Route::post('/admin2/graduation', [GraduationController::class, 'store'])->name('admin.graduation.store');
    Route::put('/admin2/graduation/{graduation}', [GraduationController::class, 'update'])->name('admin.graduation.update');
    Route::delete('/admin2/graduation/{graduation}', [GraduationController::class, 'destroy'])->name('admin.graduation.destroy');
    Route::post('/admin2/graduation/import', [GraduationController::class, 'import'])->name('graduation.import');

    // Complain management routes
    Route::get('/admin2/list-chat-complain', [ComplainController::class, 'index'])->name('admin.list-chat-complain');
    Route::get('/admin2/chat-complain/{conversationId}/messages', [ComplainController::class, 'getMessages'])->name('admin.chat-complain.messages');
    Route::post('/admin2/chat-complain/send', [ComplainController::class, 'sendMessage'])->name('admin.chat-complain.send');
    Route::post('/admin2/chat-complain/conversation/{clientId}', [ComplainController::class, 'getOrCreateConversation'])->name('admin.chat-complain.conversation');


    // User management routes
    Route::get('/admin2/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin2/users', [UserController::class, 'store'])->name('admin.user.store');
    Route::put('/admin2/users/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin2/users/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});

// Public routes
Route::view('/', 'welcome')->name('home');
Route::get('/layanan-hukum', [FrontendController::class, 'layananHukum'])->name('layanan-hukum');
Route::get('/layanan-trip', [FrontendController::class, 'layananTrip'])->name('layanan-trip');
Route::get('/layanan-complaint', [FrontendController::class, 'layananComplaint'])->name('layanan-complaint');

// Chat complaint — auth required (role check inside controller)
Route::middleware(['auth'])->group(function () {
    Route::get('/chat-complaint', [FrontendController::class, 'chatComplaint'])->name('chat-complaint');
    Route::post('/chat-complaint/send', [FrontendController::class, 'sendMessageClient'])->name('chat-complaint.send');
});
Route::get('/list-alumni', [FrontendController::class, 'listAlumni'])->name('list-alumni');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');



// // Route for testing purpose
// Route::get('/test', function () {
//     $title = 'Test Page';
//     $content = 'This is a test page.';
//     return view('test', compact('title', 'content'));
// });


// // Sample users data
// $users = [
//     [
//         'id' => 1,
//         'name' => 'Sia',
//         'age' => 25
//     ],
//     [
//         'id' => 2,
//         'name' => 'John',
//         'age' => 30
//     ]
// ];

// // For testing purpose
// Route::get('/users', function () use ($users) {
//     return $users;
// });

// Route::get('/users/{id}', function ($id) use ($users) {
//     return $users[$id - 1] ?? abort(404);
// });

// Route::post('/users', function (Request $request) use ($users) {
//     $users[] = [
//         'id' => count($users) + 1,
//         'name' => $request->input('name'),
//         'age' => $request->input('age')
//     ];
//     return response($users[count($users) - 1], 201);
// });

// Route::put('/users/{id}', function (Request $request, $id) use ($users) {
//     if (!isset($users[$id - 1])) {
//         abort(404);
//     }
//     $users[$id - 1]['name'] = $request->input('name', $users[$id - 1]['name']);
//     $users[$id - 1]['age'] = $request->input('age', $users[$id - 1]['age']);
//     return $users[$id - 1];
// });

// Route::delete('/users/{id}', function ($id) use ($users) {
//     if (!isset($users[$id - 1])) {
//         abort(404);
//     }
//     unset($users[$id - 1]);
//     return 'User deleted successfully';
// });