<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(auth()->check()){
        return redirect('/dashboard');
    }
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('event', EventController::class);
    Route::resource('guest', GuestController::class);
    Route::get('/event/register/{event}/{user}', [EventController::class, 'register_event'])->name('event.register_get');
    Route::post('/event/register/', [EventController::class, 'register_event_store'])->name('event.register_post');
    Route::post('/feedback/add',[EventController::class, 'add_feedback'])->name('feedback.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
