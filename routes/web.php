<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('message.profile.update');
    Route::get('/messenger/search', [MessageController::class , 'userSearch'])->name('message.search');
    Route::get('/get-user', [MessageController::class, 'getUser'])->name('message.getUser');
    Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('message.send');
    Route::get('/get-message', [MessageController::class, 'getMessages'])->name('message.getMessages');
    Route::get('/get-contact', [MessageController::class,'getContact'])->name('message.getContact');
});
