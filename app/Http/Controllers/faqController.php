<?php namespace App\Http\Controllers;
use CRUDbooster;
use View;
use Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class faqController extends Controller {

    public function index(){
        $data = [];
        $data['id'] = CRUDBooster::myId();
        $data['nama'] = CRUDBooster::myName();
        $data['foto'] = CRUDbooster::myPhoto();
        $data['panduan_emawas'] = DB::table('t_panduan')->where('kategori','Panduan terkait Penggunaan e-Mawas PNBP')->where('show',1)->get();
        $data['panduan_pnbp'] = DB::table('t_panduan')->where('kategori','Panduan terkait Pengawasan PNBP')->where('show',1)->get();

        //dd($data);
        return View::make('faq')->with($data);
    }
}

?>
