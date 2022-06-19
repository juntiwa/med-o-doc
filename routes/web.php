<?php

use App\Http\Controllers\Admin\ActivitylogController;
use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\DocumentController;
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
Route::get('edit_permis/{id}', [AdminController::class, 'edit'])->name('edit.permis');
Route::post('update_permis/{id}', [AdminController::class, 'update'])->name('update.permis');
Route::get('delete_activitylog', [AdminController::class, 'deleteActivity'])->name('delete.activitylog');

// ----------------------------- activity log -----------------------//
Route::controller(ActivitylogController::class)->group(function () {
    Route::get('activitylog', 'index')->name('activitylog');
    Route::get('activitylog-export', 'store')->name('activitylog.export');
});

// ----------------------------- permission -----------------------//
Route::controller(PermissionController::class)->group(function () {
    Route::get('permissions', 'index')->name('permission');
    Route::get('permission-create', 'create')->name('permission.create');
    Route::post('permission', 'store')->name('permission.store');
    Route::post('look-sapid', 'show')->name('look.sapid');
});

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
