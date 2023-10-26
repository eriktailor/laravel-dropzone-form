<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

// view our form page
Route::get('/form', [FormController::class, 'indexForm' ]);

// handle form request
Route::post('/form-submit', [FormController::class, 'submitForm' ])->name('form.submit');