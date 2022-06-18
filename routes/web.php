<?php

use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RecController;
use App\Http\Controllers\SendController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ----------------------------- signin -----------------------//

Route::get('500', function () {
    return view('errors.500');
});
Route::get('/', function () {
    if (Auth::check()) {
        Toastr::success('คุณเข้าสู่ระบบอยู่แล้ว', 'แจ้งเตือน', ['positionClass' => 'toast-top-right']);

        return back();
    } else {
        return view('auth.login');
    }
})->name('login');
Route::post('login', [AuthLoginController::class, 'authenticate'])->name('checklogin');
Route::post('logout', [AuthLoginController::class, 'logout'])->name('logout');
Route::post('check-timeout', [AuthLoginController::class, 'update'])->name('check-timeout');

// ----------------------------- admin -----------------------//
Route::get('activitylog', [AdminController::class, 'index'])->name('activitylog');
Route::get('permission', [AdminController::class, 'permis'])->name('permission');
Route::get('permission/addPermis', [AdminController::class, 'add'])->name('addPermis');
Route::post('permission/savepermiss', [AdminController::class, 'create'])->name('save.permis');
Route::get('edit_permis/{id}', [AdminController::class, 'edit'])->name('edit.permis');
Route::post('update_permis/{id}', [AdminController::class, 'update'])->name('update.permis');
Route::get('activity_log_export', [AdminController::class, 'export'])->name('activitylog.export');
Route::get('delete_activitylog', [AdminController::class, 'deleteActivity'])->name('delete.activitylog');

// ----------------------------- document -----------------------//
Route::controller(DocumentController::class)->group(function () {
    Route::get('document', 'index')->name('docShow');
    Route::post('reg-select-from', 'selectSearchfrom')->name('reg.select.from');
    Route::post('reg-select-to', 'selectSearchto')->name('reg.select.to');
    Route::get('autocomplete', 'autocomplete')->name('autocomplete');
    Route::get('searchReg', 'searchRegis')->name('reg.search');
    Route::get('open-files/{year}/{regdoc}', 'openfile')->name('reg.open.file');
    Route::get('open-files2/{year}/{regdoc}', 'openfile2')->name('reg.open.file2');
    Route::get('description-document/{regrecid}', 'show')->name('description.document');
});

// ----------------------------- send -----------------------//
Route::get('sendDoc', [SendController::class, 'index'])->name('send.show');
Route::post('send-select-from', [SendController::class, 'selectSearchfrom'])->name('send.select.from');
Route::post('send-select-to', [SendController::class, 'selectSearchto'])->name('send.select.to');
Route::post('send-autocomplete', [SendController::class, 'autocompleteSearch'])->name('send.autocomplete');
Route::get('searchSend', [SendController::class, 'searchSend'])->name('send.search');
Route::get('open-files/{year}/{senddoc}', [SendController::class, 'openfile'])->name('send.open.file');
Route::get('open-files2/{year}/{senddoc}', [SendController::class, 'openfile2'])->name('send.open.file2');

// ----------------------------- rec -----------------------//
Route::get('recDoc', [RecController::class, 'index'])->name('rec.show');
Route::post('rec-select-from', [RecController::class, 'selectSearchfrom'])->name('rec.select.from');
Route::post('rec-select-to', [RecController::class, 'selectSearchto'])->name('rec.select.to');
Route::post('rec-autocomplete', [RecController::class, 'autocompleteSearch'])->name('rec.autocomplete');
Route::get('searchRec', [RecController::class, 'searchRec'])->name('rec.search');
Route::get('open-files/{year}/{recdoc}', [RecController::class, 'openfile'])->name('rec.open.file');
Route::get('open-files2/{year}/{recdoc}', [RecController::class, 'openfile2'])->name('rec.open.file2');
