<?php namespace App\Http\Controllers;
use CRUDbooster;
use View;
use Illuminate\Support\Facades\DB;
use Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class homepageController extends Controller {

    public function index(){

        $data = [];
        $data['id'] = CRUDBooster::myId();
        $data['nama'] = CRUDBooster::myName();
        $data['foto'] = CRUDbooster::myPhoto();
        $data['artikel'] = DB::table('t_article')->orderBy('id','desc')->get();
        $data['infografis'] = DB::table('t_infografis')->orderBy('id','desc')->get();
        $data['pengumuman'] = DB::table('t_pengumuman')->where('show',1)->orderByDesc('id')->get();

                $get_pnbp = DB::table('t_diag_pnbp_jenis')->selectRaw('tahun,komp_pnbp,nominal')->groupBy(['tahun','komp_pnbp','nominal'])->get();

                $pnbps = $get_pnbp
                ->map(function($item){
                    return [
                        'Tahun' => $item->tahun,
                        $item->komp_pnbp => $item->nominal,
                        'nominal' => $item->nominal
                    ];
                });
                $array_pnbps = $pnbps->groupBy('Tahun')->map(function ($item) {
                    $item[4] = ['Total' => $item->sum('nominal')];
                    return array_merge(...$item->toArray());
            })->values()->toArray();
       $data['pnbp_jenis'] = json_encode($array_pnbps);

        $get_trend = DB::table('t_diag_tren_pnbp')->selectRaw('tahun,realisasi_pnbp,realisasi_pn,persentase')->get();
       $data['pnbp_tren'] = json_encode($get_trend);

       $st_kirim = 2;
       $l_tahun = 2019;

       $data['tahunSelector'] = DB::table('t_lap_awas')->where('id_status_kirim',$st_kirim)->where('tahun','>=',$l_tahun)->get();
       $tahuns = array_values((collect($data['tahunSelector']->unique('tahun'))->map(function($item){
           return ['tahun' => $item->tahun];
       }))->toArray());

       $data['pnbp_temuan_All'] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_temuan2.Deskripsi AS `Jenis Temuan`')
       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
       ->join('t_ref_kod_temuan AS t_ref_kod_temuan2','t_ref_kod_temuan.id_up','=','t_ref_kod_temuan2.id')
       ->where('t_lap_awas.id_status_kirim',2)
       ->where('t_lap_awas.tahun', '>=', $l_tahun)
       ->groupBy('t_ref_kod_temuan2.Deskripsi')
       ->get());

        $data['pnbp_tl_All'] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_tl.deskripsi AS `Jenis Tindak Lanjut`')
        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
        ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
        ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
        ->where('t_lap_awas.id_status_kirim',2)
        ->where('t_lap_awas.tahun', '>=', $l_tahun)
        ->groupBy('t_ref_tl.deskripsi')
        ->get());

        for($x = 0; $x < count($tahuns); ++$x){
            $data['pnbp_temuan_'.$tahuns[$x]['tahun']] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_temuan2.Deskripsi AS `Jenis Temuan`')
            ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
            ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
            ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
            ->join('t_ref_kod_temuan AS t_ref_kod_temuan2','t_ref_kod_temuan.id_up','=','t_ref_kod_temuan2.id')
            ->where('t_lap_awas.id_status_kirim',2)
            ->where('t_lap_awas.tahun', '=', $tahuns[$x]['tahun'])
            ->groupBy('t_ref_kod_temuan2.Deskripsi')
            ->get());
            $data['pnbp_tl_'.$tahuns[$x]['tahun']] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_tl.deskripsi AS `Jenis Tindak Lanjut`')
            ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
            ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
            ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
            ->where('t_lap_awas.id_status_kirim',2)
            ->where('t_lap_awas.tahun', '=', $tahuns[$x]['tahun'])
            ->groupBy('t_ref_tl.deskripsi')
            ->get());
        }

        //dd($data);
        return View::make('homepage')->with($data);
    }


}

?>
