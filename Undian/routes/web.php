<?php

use App\Http\Controllers\HadiahController;
use App\Http\Controllers\LoginController;
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

    // echo "<pre>";
    // print_r($periode);die;
    //tanggal
    $today = date_create(date("Y-m-d"));
    $to = date_create($data_periode['tgl_expired']);
    $date_diff =  date_diff($today,$to);
    // echo "<pre>";
    
    // print_r($json);die;
    // $merge = array_merge($json_response['periode'],$json_response['jumlah']);
    return view('home', compact('title','date_diff'));
});

Route::get('/lokasi', function () {
    $title = "Lokasi";
    return view('lokasi', compact('title'));
});

Route::get('/getChart', function(){
    $data = DB::table('sistems')->selectRaw('sistems.nama_periode, count(hadiahs.id) as jumlah')
    ->join('hadiahs','hadiahs.periode_id','=','sistems.id')
    ->groupBy('hadiahs.periode_id')->get();

    $periode = [];
    $jumlah = [];
    for($i = 0;$i < sizeof($data);$i++){
        $periode[$i] = $data[$i]->nama_periode;
        $jumlah[$i] = $data[$i]->jumlah;
    }

    $json_response['periode'] = $periode;
    $json_response['jumlah'] = $jumlah;
    return json_encode($json_response);

});

// Route::get('/login', function(){
//     $title = "Login";
//     return view('login', compact('title'));
// });

Route::post('/postLogin',[LoginController::class, 'login']);

Route::get('/hadiah', [HadiahController::class, 'halaman_hadiah']);
Route::get('/pemenang', [HadiahController::class, 'halaman_pemenang']);

Route::controller(['Auth'])->group(function () {
    Route::resource('undian',HadiahController::class);
    Route::get('/getHadiah',[HadiahController::class, 'getHadiah']);
    Route::get('/postPemenang',[HadiahController::class, 'postPemenang']);
    Route::get('/getPemenang',[HadiahController::class, 'getPemenang']);
    Route::get('/getLogout',[HadiahController::class, 'getLogout']);
})->middleware('Auth');



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');