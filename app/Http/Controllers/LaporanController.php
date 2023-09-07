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
            $data = DB::connection('sqlsrv')
            ->table('saldo_undian')
            ->select('norekening', DB::raw('(point_sd_nov + point_dec + point_jan + point_feb + point_mar + point_apr) as point'), 'namalengkap')
            ->orderBy('point', 'DESC')
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
            $pembagi = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $results = DB::connection('sqlsrv')
            ->table('saldoharian_tab')
            ->select('saldoharian_tab.noacc', 'cif.namaidentitas')
            ->selectRaw("CAST(((saldo_1 + saldo_2 + saldo_3 + saldo_4 + saldo_5 + saldo_6 + saldo_7 + saldo_8 + saldo_9 + saldo_10 + saldo_11 + saldo_12 + saldo_13 + saldo_14 + saldo_15 + saldo_16 + saldo_17 + saldo_18 + saldo_19 + saldo_20 + saldo_21 + saldo_22 + saldo_23 + saldo_24 + saldo_25 + saldo_26 + saldo_27 + saldo_28 + saldo_29 + saldo_30 + saldo_31) / $pembagi) AS INT) as saldo")
            ->selectRaw("FLOOR(((saldo_1 + saldo_2 + saldo_3 + saldo_4 + saldo_5 + saldo_6 + saldo_7 + saldo_8 + saldo_9 + saldo_10 + saldo_11 + saldo_12 + saldo_13 + saldo_14 + saldo_15 + saldo_16 + saldo_17 + saldo_18 + saldo_19 + saldo_20 + saldo_21 + saldo_22 + saldo_23 + saldo_24 + saldo_25 + saldo_26 + saldo_27 + saldo_28 + saldo_29 + saldo_30 + saldo_31) / $pembagi) / 100000) as point")
            ->join('tabmaster', 'saldoharian_tab.noacc', '=', 'tabmaster.norekening')
            ->join('cif', 'tabmaster.cif', '=', 'cif.cif')
            ->where('saldoharian_tab.tahun', $year)
            ->where('saldoharian_tab.bulan', $month)
            ->where(DB::raw("SUBSTRING(saldoharian_tab.noacc, 6, 2)"), '07')
            ->orderBy('point', 'desc')
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
