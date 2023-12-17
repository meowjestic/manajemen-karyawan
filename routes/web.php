<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware'=>'guest'], function() {
    Route::get('/', function () {
        return view('components/login');
    })->name('login')->middleware('guest');
    Route::get('/login/auth', [UserController::class, 'authenticate']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');

    Route::get('/karyawan/getAll', [EmployeeController::class, 'getAll'])->name("getAllKaryawan");
    Route::get('/user/getAll', [UserController::class, 'getAll'])->name("getAllUser");
    Route::get('/divisi', [DivisionController::class, 'index']);
    Route::get('/karyawan/export_excell', [EmployeeController::class, 'export_excell']);
    Route::get('/karyawan/{uuid}/pdf', [EmployeeController::class, 'download_pdf']);

    Route::resource('/karyawan', EmployeeController::class);
    Route::resource('/user', UserController::class);
});


// Route::get('/', function () {
//     return view('dashboard');
// })->middleware('auth');