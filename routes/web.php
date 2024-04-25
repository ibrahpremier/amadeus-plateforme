<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::resources([
    'reservation'=>ReservationController::class,
    'ticket'=>TicketController::class,
    'user'=>UserController::class,
    'dashboard'=>DashboardController::class,
]
,['middleware' => ['auth']]
);

Route::get('/login',[UserController::class,'loginForm'])->name('login');
Route::get('/r1',[UserController::class,'resetPasswordEmailForm'])->name('password.email-ask');
Route::get('/r2/{code?}',[UserController::class,'resetPasswordForm'])->name('password.newpass-ask');
Route::get('/download/{ticket_id}',[TicketController::class,'download'])->name('download.reponse_file');

Route::post('/auth-login',[UserController::class,'login'])->name('auth.login');
// Route::get('/register',[UserController::class,'registerForm'])->name('register');
Route::post('/password/reset',[UserController::class,'resetPassword'])->name('password.reset');
Route::post('/password/send',[UserController::class,'sendEmail'])->name('password.send');
Route::get('disconnect', [UserController::class, 'disconnect'])->middleware('auth')->name('disconnect');
// Route::post('/register',[UserController::class,'register'])->name('auth.register');

