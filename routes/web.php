<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\SendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();
Route::get('/', function () {
   return view('auth.login');
})->name('login');

Route::post('/login', [AuthLoginController::class, 'authenticate'])->name('checklogin');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/index', [HomeController::class, 'index'])->name('index');

// reg
Route::get('/regDoc', [RegController::class, 'index'])->name('reg.show');
Route::post('/reg-select', [RegController::class, 'selectSearch'])->name('reg.select');
Route::post('/reg-autocomplete', [RegController::class, 'autocompleteSearch'])->name('reg.autocomplete');
// Route::post( '/searchReg', [RegController::class, 'searchRegis'])->name('reg.search');
Route::get('/searchReg', [RegController::class, 'searchRegis'])->name('reg.search');

// send
Route::get('/sendDoc', [SendController::class, 'index'])->name('send.show');
Route::post('/send-select', [SendController::class, 'selectSearch'])->name('send.select');
Route::post('/send-autocomplete', [SendController::class, 'autocompleteSearch'])->name('send.autocomplete');
// Route::post('/searchSend', [SendController::class, 'searchSend'])->name('send.search');
Route::get('/searchSend', [SendController::class, 'searchSend'])->name('send.search');
// rec
Route::get('/recDoc', [RecController::class, 'index'])->name('rec.show');
Route::post('/rec-select', [RecController::class, 'selectSearch'])->name('rec.select');
Route::post('/rec-autocomplete', [RecController::class, 'autocompleteSearch'])->name('rec.autocomplete');
// Route::post('/searchRec', [RecController::class, 'searchRec'])->name('rec.search');
Route::get('/searchRec', [RecController::class, 'searchRec'])->name('rec.search');