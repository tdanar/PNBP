<?php

namespace App\Http\Controllers;
use CRUDbooster;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class lhcredirController extends Controller
{
    public function index(){
        $data = [];
        $data["url"] = Session::get('url');
       
        return View::make('lhcredir')->with($data);
    }
}
