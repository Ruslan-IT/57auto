<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\IndexController;
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


Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/car/{id}', [IndexController::class, 'show'])->name('car.show'); // <-- добавляем





// Подгрузка моделей при выборе марк
Route::get('/api/models/{brandId}', [FilterController::class, 'getModels'])->name('api.models');
Route::post('/filter', [FilterController::class, 'filter'])->name('filter');


Route::post('/form-submit', [FormController::class, 'submit'])->name('form.submit');








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

Route::get('/calculator', function () {

    return redirect('/calculator/korea');

});

Route::post('/calculator/calculate', [CalculatorController::class, 'calculate'])
    ->name('calculator.calculate');

Route::get('/calculator/{country}', [CalculatorController::class, 'index']) ->name('calculator.index');






Route::view('/offer', 'legal.offer');
Route::view('/privacy', 'legal.privacy');
//Route::view('/contacts', 'legal.contact');

require __DIR__.'/auth.php';
