<?php

use App\Http\Controllers\MortgageCalculatorController;
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

Route::get('/', [MortgageCalculatorController::class, 'index'])->name('form.index');
Route::post('store-form', [MortgageCalculatorController::class, 'store'])->name('submit.form');;
Route::get('list', [MortgageCalculatorController::class, 'show'])->name('list');;


