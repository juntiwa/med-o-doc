<?php

use App\Http\Controllers\Admin\CheckUserController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterContrller;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Imports\MemberImportContorller;
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
    Route::post('autocompleteOutter', 'autocompleteUnitOutter')->name('document.unitoutter');
    Route::get('open-files/{year}/{regdoc}', 'openfile')->name('document.openfile');
    Route::get('open-files2/{year}/{regdoc}', 'openfile2')->name('document.openfile2');
});

Route::controller(DescriptionController::class)->group(function () {
    Route::get('description/{idTitle}', 'show')->name('descriptions');
});

Route::controller(ManageController::class)->group(function () {
    Route::get('manages', 'index')->name('manages');
    Route::get('manage-create', 'create')->name('manage.create');
    Route::post('manage-store', 'store')->name('manage.store');
    Route::post('show-sapid', 'show')->name('manage.sapid');
    Route::get('manage-edit/{org_id}', 'edit')->name('manage.edit');
    Route::post('manage-update/{org_id}', 'update')->name('manage.update');
});

Route::controller(CheckUserController::class)->group(function () {
    Route::post('exist-user', 'store')->name('exist.user');
    Route::post('check-sapid', 'show')->name('check.sapid.show');
});

Route::controller(HistoryController::class)->group(function () {
    Route::get('activity-log', 'index')->name('logactivitys');
    Route::get('export-activity-log', 'export')->name('logactivity.export');
});

Route::get('404',function(){
    return view('errors.404');
})->name('404');
