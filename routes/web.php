<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveDocumentController;
use App\Http\Controllers\CategoryDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();



/*
   ** ROUTE NAMING **
   note: naming use prefix dashboard.
   example : dashboard.user.index
*/
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // ROUTE FOR ARCHIVE
    Route::prefix('archive')->group(function () {
        Route::get('/', [ArchiveDocumentController::class, 'index'])->name('archive');
        Route::get('/create', [ArchiveDocumentController::class, 'create'])->name('create');
    });

    // ROUTE FOR LOCKER
    Route::prefix('locker')->name('locker.')->group(function () {
        Route::get('/', [LockerController::class, 'index'])->name('index');
        Route::get('/create', [LockerController::class, 'create'])->name('create');
    });

    // ROUTE FOR DOCUMENT CATEGORY
    Route::resource('category', CategoryDocumentController::class);
    Route::prefix('category')->group(function () {
    });


    // ROUTE FOR USER
    Route::resource('user', UserController::class);

    Route::prefix('user')->name('user.')->group(function () {

        //ROUTE FOR JSON RESPONSE
        Route::prefix('get')->name('get.')->middleware(['json-response'])->group(function () {
            Route::post('user-datatable', [UserController::class, 'getUserDatatable'])->name('user-datatable');
        });
    });
});
