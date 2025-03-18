<?php

use App\Http\Controllers\AgenceController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\MinistereController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
// use App\Http\Middleware\DotationAnnulle;

// Route::middleware(['auth', DotationAnnulle::class])->group(function () {

Route::get('/', function () {
    return redirect('dashboard');
});

Route::resources(
    [
        'agence' => AgenceController::class,
        'ministere' => MinistereController::class,
        'reservation' => ReservationController::class,
        'facture' => FactureController::class,
        'ticket' => TicketController::class,
        'user' => UserController::class,
        'dashboard' => DashboardController::class,
        'compagnie' => CompagnieController::class,
        'budget' => BudgetController::class
    ]
);

Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::get('/r1', [UserController::class, 'resetPasswordEmailForm'])->name('password.email-ask');
Route::get('/r2/{code?}', [UserController::class, 'resetPasswordForm'])->name('password.newpass-ask');
Route::get('/download/{ticket_id}', [TicketController::class, 'download'])->name('download.reponse_file');
Route::get('/commande/{id}', [ReservationController::class, 'genererBonCommande'])->name('pdf.bon-commande');


Route::post('/auth-login', [UserController::class, 'login'])->name('auth.login');
// Route::get('/register',[UserController::class,'registerForm'])->name('register');
Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('password.reset');
Route::post('/password/send', [UserController::class, 'sendEmail'])->name('password.send');
Route::get('disconnect', [UserController::class, 'disconnect'])->middleware('auth')->name('disconnect');
    // Route::post('/register',[UserController::class,'register'])->name('auth.register');
// });