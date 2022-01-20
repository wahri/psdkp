<?php

use App\Http\Controllers\Archive;
use App\Http\Controllers\CategoryDocumentController;
use App\Http\Controllers\Dashboard;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Auth::routes();

Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
Route::get('/dashboard/archive', [Archive::class, 'index'])->name('archive');

Route::resource('/dashboard/category', CategoryDocumentController::class);
