<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentFormatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Node\Block\Document;

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
        Route::get('/', [ArchiveController::class, 'index'])->name('archive');
    });

    // ROUTE FOR DOCUMENT CATEGORY
    Route::prefix('document-format')->name('document-format.')->group(function () {
        Route::get("/", [DocumentFormatController::class, 'index'])->name('index');
        Route::get("/create", [DocumentFormatController::class, 'create'])->name('create');
        Route::post("/store", [DocumentFormatController::class, 'store'])->name('store');
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
