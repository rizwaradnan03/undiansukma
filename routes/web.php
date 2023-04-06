<?php

use App\Http\Controllers\HadiahController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SetupController;
use App\Models\Hadiah;
use App\Models\Sistem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $title = "Homepage";
    $data_periode = Sistem::where('status','=','0')->first();

    $today = date_create(date("Y-m-d"));
    $to = date_create($data_periode['tgl_expired']);
    $date_diff =  date_diff($today,$to);

    return view('home', compact('title','date_diff'));
});

Route::get('/lokasi', function () {
    $title = "Lokasi";
    return view('lokasi', compact('title'));
});

Route::post('/postLogin',[LoginController::class, 'login']);

Route::get('/hadiah', [HadiahController::class, 'halaman_hadiah']);
Route::get('/pemenang', [HadiahController::class, 'halaman_pemenang']);

Route::controller(['Auth'])->group(function () {
    Route::get('/listperiode', [PeriodeController::class, 'listperiode']);
    Route::post('/updateperiode', [PeriodeController::class, 'updateperiode']);
    Route::resource('undian',HadiahController::class);
    Route::resource('setup',SetupController::class);
    Route::resource('periode',PeriodeController::class);
    Route::get('/getHadiah',[HadiahController::class, 'getHadiah']);
    Route::post('/postPemenang',[HadiahController::class, 'postPemenang']);
    Route::get('/getPemenang',[HadiahController::class, 'getPemenang']);
    Route::get('/getLogout',[HadiahController::class, 'getLogout']);
})->middleware('Auth');



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');