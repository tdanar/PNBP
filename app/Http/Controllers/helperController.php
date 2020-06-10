<?php

namespace App\Http\Controllers;

use CRUDBooster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class helperController extends \crocodicstudio\crudbooster\controllers\CBController
{
    public function refereshCapcha(){
        return captcha_img('flat');
    }
}
