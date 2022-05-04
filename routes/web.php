<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Admin\AdminController as AdminController;
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

// ----------------------------- signin -----------------------//
Auth::routes();
Route::get('/', function () {
   return view('auth.login');
})->name('login');
Route::post('login', [AuthLoginController::class, 'authenticate'])->name('checklogin');
Route::post('logout', [ AuthLoginController::class, 'logout'])->name('logout');
Route::post('check-timeout', [AuthLoginController::class, 'update'])->name('check-timeout');

// ----------------------------- admin -----------------------//
Route::get('activitylog',[AdminController::class, 'index'])->name('activitylog');
Route::get('permission', [AdminController::class, 'permis'])->name('permission');
Route::post('permission/savepermiss', [ AdminController::class, 'create'])->name('save.permis');
Route::get('delete_permis/{id}', [AdminController::class, 'delete'])->name('delete.permis');
Route::get('activity_log_export', [AdminController::class, 'export'])->name('activitylog.export');
Route::get('delete_activitylog', [AdminController::class, 'deleteActivity'])->name('delete.activitylog');

// ----------------------------- reg -----------------------//
Route::get('regDoc', [RegController::class, 'index'])->name('reg.show');
Route::post('reg-select-from', [RegController::class, 'selectSearchfrom'])->name('reg.select.from');
Route::post('reg-select-to', [RegController::class, 'selectSearchto'])->name('reg.select.to');
Route::post('reg-autocomplete', [RegController::class, 'autocompleteSearch'])->name('reg.autocomplete');
Route::get('searchReg', [RegController::class, 'searchRegis'])->name('reg.search');
Route::get('open-files/{year}/{type}/{regdoc}',[RegController::class,'openfile'])->name('open.file');

// ----------------------------- send -----------------------//
Route::get('sendDoc', [SendController::class, 'index'])->name('send.show');
Route::post('send-select-from', [SendController::class, 'selectSearchfrom'])->name('send.select.from');
Route::post('send-select-to', [SendController::class, 'selectSearchto'])->name('send.select.to');
Route::post('send-autocomplete', [SendController::class, 'autocompleteSearch'])->name('send.autocomplete');
Route::get('searchSend', [SendController::class, 'searchSend'])->name('send.search');
Route::get('open-files/{year}/{type}/{senddoc}', [SendController::class, 'openfile'])->name('open.file');

// ----------------------------- rec -----------------------//
Route::get('recDoc', [RecController::class, 'index'])->name('rec.show');
Route::post('rec-select-from', [RecController::class, 'selectSearchfrom'])->name('rec.select.from');
Route::post('rec-select-to', [RecController::class, 'selectSearchto'])->name('rec.select.to');
Route::post('rec-autocomplete', [RecController::class, 'autocompleteSearch'])->name('rec.autocomplete');
Route::get('searchRec', [RecController::class, 'searchRec'])->name('rec.search');
Route::get('open-files/{year}/{type}/{recdoc}', [RecController::class, 'openfile'])->name('open.file');
