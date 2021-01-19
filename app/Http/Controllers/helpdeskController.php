<?php namespace App\Http\Controllers;
use CRUDbooster;
use View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class helpdeskController extends Controller {

    public function index(){
        $data = [];
        $data['id'] = CRUDBooster::myId();
        $data['nama'] = CRUDBooster::myName();
        $data['email'] = CRUDBooster::me()->email;
        $data['foto'] = CRUDbooster::myPhoto();
        $data['privId'] = CRUDBooster::myPrivilegeId();
        $data['username'] = CRUDBooster::myUsername();
        $data['ajaib'] = CRUDBooster::myAjaib();
        //dd($data);
       
        return View::make('helpdesk')->with($data);
    }

    
}

?>
