<?php

namespace App\Http\Controllers;

    use Session;
	use Request;
	use DB;
	use CRUDBooster;

class manajemenGrafikController extends \crocodicstudio\crudbooster\controllers\CBController{

    public function cbInit() {}
    public function Index()
    {
        
        if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
        $data['page_title'] = 'Manajemen Grafik Beranda';
        $this->cbView('manajemenGrafik',$data);
    }
}
