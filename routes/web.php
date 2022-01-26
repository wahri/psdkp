<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveDocumentController;
use App\Http\Controllers\CategoryDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\StorageController;
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
    Route::prefix('storage')->name('storage.')->group(function () {
        Route::get('/', [StorageController::class, 'index'])->name('index');
        Route::post('create-room', [StorageController::class, 'StoreRoom'])->name('create.room');
        Route::get('/{room_id}', [StorageController::class, 'room'])->name('room');
        Route::post('{room_id}/locker', [StorageController::class, 'StoreLocker'])->name('create.room.locker');
        Route::get('/{room}/{locker}', [StorageController::class, 'locker'])->name('locker');
        Route::post('/locker/rack', [StorageController::class, 'StoreRack'])->name('create.room.locker.rack');
        Route::post('/rack/box', [StorageController::class, 'StoreBox'])->name('create.room.locker.rack.box');
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
