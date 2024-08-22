<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('pdf/{event}', PdfController::class)->name('pdf'); 


