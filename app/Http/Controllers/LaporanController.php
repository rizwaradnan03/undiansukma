<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporanperolehan(){
        if(Auth::check()){
            $title = 'Laporan Perolehan';
            return view('laporan_perolehan', compact('title'));
        }else{
            return redirect('/');
        }
    }

    public function laporanperbulan(){
        if(Auth::check()){
            $title = 'Laporan Perbulan';
            $data = DB::table('undians')
            ->selectRaw("DATE_FORMAT(created_at, '%M %Y') AS date, COUNT(*) AS jumlah")
            ->groupBy('date')
            ->get();
            return view('laporan_perbulan', compact('title','data'));
        }else{
            return redirect('/');
        }
    }

    public function getPerolehan(Request $request){
        if(Auth::check()){
            $month = $request->input('month');
            $year = $request->input('year');

            $results = DB::table('undians')
                ->select('nama_lengkap', DB::raw('COUNT(*) as jumlah'))
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->groupBy('nama_lengkap')
                ->get();

            if(sizeof($results) != 0){
                $response_data['status'] = 'berhasil';
                $response_data['data'] = $results;
            }else if(sizeof($results) == 0){
                $response_data['status'] = 'gagal';
            }else{
                $response_data['status'] = "";
            }

            return json_encode($response_data);
        }else{
            return redirect('/');
        }
    }

}
