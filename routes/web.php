<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;



Route::get('/dashboard', function () {
    return view('page.dashboard');
})->middleware('auth', 'verified')->name('dashboard');




Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::get('/blog', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog-single', [BlogController::class, 'show'])->name('blogs.show');


Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Route::get('/account', [AccountController::class, 'index'])->name('account.index');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});




Route::view('/offer', 'legal.offer');
Route::view('/privacy', 'legal.privacy');
//Route::view('/contacts', 'legal.contact');

require __DIR__.'/auth.php';
