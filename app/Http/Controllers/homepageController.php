<?php namespace App\Http\Controllers;
use CRUDbooster;
use View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class homepageController extends Controller {

    public function index(){
        $data = [];
        $data['id'] = CRUDBooster::myId();
        $data['nama'] = CRUDBooster::myName();
        $data['foto'] = CRUDbooster::myPhoto();
        //dd($data);
        return View::make('homepage')->with($data);
    }
}

?>
