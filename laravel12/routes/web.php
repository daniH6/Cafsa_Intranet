<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteConductaController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\TipoCambioController;
use App\Http\Controllers\RestringidosController;
use App\Http\Controllers\GoogleCalendarController;

use Illuminate\Support\Facades\Route;

Route::get('/', [MainPageController::class, 'Main'])->name('welcome');

Route::get('google/redirect', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.redirect');

Route::get('/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('calendar/events', [GoogleCalendarController::class, 'listEvents'])->name('calendar.events');

Route::get('calendar/create', [GoogleCalendarController::class, 'createEvent'])->name('calendar.create');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [RestringidosController::class, 'index'])->name('dashboard');
    
    
    Route::get('/apps', function() { return view('apps'); })->name('apps');
});

Route::post('/reporteConductas', [ReporteConductaController::class, 'submit'])->name('reporteConductas.submit');

Route::get('/reporteConductas', function() {
    return view('reporteConductas');
})-> name('reporteConductas');

Route::get('/cumplimiento', function() {
    return view('cumplimiento');
})-> name('cumplimiento');

Route::get('/beneficios', function() {
    return view('beneficios');
})-> name('beneficios');

Route::get('/enlaces-importantes', function() {
    return view('enlaces-importantes');
})-> name('enlaces-importantes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/teacher-auth.php';