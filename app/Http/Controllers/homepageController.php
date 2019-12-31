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
        //dd($data);
        return View::make('homepage')->with($data);
    }
}

?>
