<?php

use App\Http\Controllers\Archive;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryDocumentController;
use App\Http\Controllers\Dashboard;
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
    Route::get('/', [Dashboard::class, 'index'])->name('index');

    // ROUTE FOR ARCHIVE
    Route::prefix('archive')->group(function () {
        Route::get('/', [ArchiveController::class, 'index'])->name('archive');
    });

    // ROUTE FOR DOCUMENT CATEGORY
    Route::resource('category', CategoryDocumentController::class);
    Route::prefix('category')->group(function () {
    });


    // ROUTE FOR USER
    Route::resource('user', UserController::class);
    Route::prefix('user')->group(function () {
    });
});
