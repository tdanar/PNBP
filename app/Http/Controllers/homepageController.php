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
        $data['slideshow'] = DB::table('t_slideshow')->where('show',1)->orderByDesc('id')->get();
        $data['infografis'] = DB::table('t_infografis')->orderBy('id','desc')->get();
        $data['pengumuman'] = DB::table('t_pengumuman')->where('show',1)->orderByDesc('id')->get();
        $data['videoshow'] = DB::table('t_videoshow')->where('show',1)->orderByDesc('id')->get();

         
       $st_kirim = 2;
       $f_tahun = CRUDBooster::getSetting('f_tahun') ? CRUDBooster::getSetting('f_tahun') : (now()->year)-4 ;
       $l_tahun = CRUDBooster::getSetting('l_tahun') ? CRUDBooster::getSetting('l_tahun') : (now()->year) ;
       $tahun1 = CRUDBooster::getSetting('tahun_1') ? CRUDBooster::getSetting('tahun_1') : (now()->year)-4 ;
        $tahun2 = CRUDBooster::getSetting('tahun_2') ? CRUDBooster::getSetting('tahun_2') : (now()->year) ;
        $tahun3 = CRUDBooster::getSetting('tahun_3') ? CRUDBooster::getSetting('tahun_3') : (now()->year)-4 ;
        $tahun4 = CRUDBooster::getSetting('tahun_4') ? CRUDBooster::getSetting('tahun_4') : (now()->year) ;
        $tahun5 = CRUDBooster::getSetting('tahun_5') ? CRUDBooster::getSetting('tahun_5') : (now()->year) ;

        $sumber1 = CRUDBooster::getSetting('sumber_1') ? CRUDBooster::getSetting('sumber_1') : "LKPP Audited" ;
        $sumber2 = CRUDBooster::getSetting('sumber_2') ? CRUDBooster::getSetting('sumber_2') : "LKPP Audited" ;
        $sumber3 = CRUDBooster::getSetting('sumber_3') ? CRUDBooster::getSetting('sumber_3') : "Aplikasi SIMPONI" ;


        $data['tahun1'] = $tahun1;
        $data['tahun2'] = $tahun2;
        $data['tahun3'] = $tahun3;
        $data['tahun4'] = $tahun4;
        $data['tahun5'] = $tahun5;
        $data['sumber1'] = $sumber1;
        $data['sumber2'] = $sumber2;
        $data['sumber3'] = $sumber3;


       $data['tahunSelector'] = DB::table('t_lap_awas')->where('id_status_kirim',$st_kirim)->where('tahun','>=',$f_tahun)->where('tahun','<=',$l_tahun)->get();
        //dd($data);
        return View::make('homepage')->with($data);
    }

    public function getPiePNBP($tahun = null)
    {
        $data = [];
        $l_tahun = (now()->year) - 2;
        if($tahun){
            $tahuns = (int)$tahun;
            $oprt = '=';
        }else{
            $tahuns = $l_tahun;
            $oprt = '>=';
        }
       $data['pnbp_temuan'] = DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_temuan2.Deskripsi AS `Jenis Temuan`')
       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
       ->join('t_ref_kod_temuan AS t_ref_kod_temuan2','t_ref_kod_temuan.id_up','=','t_ref_kod_temuan2.id')
       ->where('t_lap_awas.id_status_kirim',2)
       ->where('t_lap_awas.tahun', $oprt, $tahuns)
       ->groupBy('t_ref_kod_temuan2.Deskripsi')
       ->get();

        $data['pnbp_tl'] = DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_tl.deskripsi AS `Jenis Tindak Lanjut`')
        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
        ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
        ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
        ->where('t_lap_awas.id_status_kirim',2)
        ->where('t_lap_awas.tahun', $oprt, $tahuns)
        ->groupBy('t_ref_tl.deskripsi')
        ->get();
        //dd($oprt,$tahuns);
       return $data;
    }

    public function getTrenPNBP($tahun1 = null, $tahun2 = null, $tahun3 = null, $tahun4 = null, $tahun5 = null)
    {
        
        
        $get_pnbp = DB::table('t_diag_pnbp_jenis')->selectRaw('tahun,komp_pnbp,nominal')->where('tahun','>=',$tahun1)->where('tahun','<=',$tahun2)->groupBy(['tahun','komp_pnbp','nominal'])->get();

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
       $data['pnbp_jenis'] = $array_pnbps;

        $get_trend = DB::table('t_diag_tren_pnbp')->selectRaw('tahun,realisasi_pnbp,realisasi_pn,persentase')->where('tahun','>=',$tahun3)->where('tahun','<=',$tahun4)->get();
        $get_rank = DB::table('t_diag_rank_pnbp')->selectRaw('tahun,t_ref_unit.singkat AS category,realisasi_pnbp AS realization,target_pnbp AS target,t_ref_unit.logo AS bullet')->join('t_ref_unit','t_ref_unit.id','=','t_diag_rank_pnbp.id_kl')->where('tahun',$tahun5)->get();
            
       $data['pnbp_tren'] = $get_trend;
       $data['pnbp_rank'] = $get_rank;

       
       return $data;
    }


}

?>
