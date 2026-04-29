<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::post( '/yookassa/webhook' , WebhookController::class);
