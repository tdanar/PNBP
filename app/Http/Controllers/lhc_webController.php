<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class lhc_webController extends Controller
{
    public function getLHC(){
        $url = 'http://'.config('lhc.login_url');
        return Redirect::to($url);
    }
}
