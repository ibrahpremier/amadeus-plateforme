<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('layout');
});

Route::resources([
    'reservation'=>ReservationController::class,
]
// ,['middleware' => ['auth']]
);


// Route::get('/contact-adm',[DashboardController::class,'contactAdm'],['middleware' => ['auth']])->name('contact-adm');
