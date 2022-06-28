<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterContrller;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    toastr()->info('Have fun storming the castle!', 'Miracle Max Says');

    return view('welcome');
}); */

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/checklogin', 'authenticate')->name('login.authenticate');
    Route::post('savestart', 'store')->name('startapp.store');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(RegisterContrller::class)->group(function () {
    Route::post('saveregister', 'store')->name('register.store');
});

Route::controller(DocumentController::class)->group(function () {
    Route::get('documents', 'index')->name('documents');
    Route::get('document', 'show')->name('document.search');
    Route::post('selectInner', 'selectUnitInner')->name('document.unitinner');
    Route::get('autocompleteOutter', 'autocompleteUnitOutter')->name('document.unitoutter');
    Route::get('open-files/{year}/{regdoc}', 'openfile')->name('document.openfile');
    Route::get('open-files2/{year}/{regdoc}', 'openfile2')->name('document.openfile2');
});

Route::controller(DescriptionController::class)->group(function () {
    Route::get('description', 'index')->name('descriptions');
});
