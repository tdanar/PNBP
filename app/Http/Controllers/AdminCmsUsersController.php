<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;

class AdminCmsUsersController extends \crocodicstudio\crudbooster\controllers\CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'cms_users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = 'button_icon';
		$this->button_import 	   = FALSE;
		$this->button_export 	   = FALSE;
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
        $this->col[] = array("label"=>"Name","name"=>"name");
		$this->col[] = array("label"=>"Username","name"=>"username");
		$this->col[] = array("label"=>"Email","name"=>"email");
		$this->col[] = array("label"=>"Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
		$this->col[] = array("label"=>"Photo","name"=>"photo","image"=>1);
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array();
        $this->form[] = array("label"=>"Nama","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Username","name"=>"username",'required'=>true,'validation'=>'required|alpha_dash|min:3|unique:cms_users,username,'.CRUDBooster::getCurrentId());
		$this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());
        $this->form[] = array("label"=>"Foto","name"=>"photo","type"=>"upload","help"=>"Rekomendasi resolusinya 200x200px",'validation'=>'image|max:1000','resize_width'=>90,'resize_height'=>90);
        if(!CRUDBooster::isSuperadmin()) {
        $this->form[] = array("label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name","datatable_where"=>"is_superadmin<>1",'required'=>true);
        }else{
        $this->form[] = array("label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name",'required'=>true);
        }
		$this->form[] = array("label"=>"Kementerian / Lembaga","name"=>"id_kode_unit","type"=>"select2","datatable"=>"t_ref_unit,unit",'required'=>true);
		// $this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password",'validation'=>'confirmed|min:8',"help"=>"Biarkan kosong apabila tidak ada perubahan");
		$this->form[] = array("label"=>"Konfirmasi Password","name"=>"password_confirmation","type"=>"password","help"=>"Biarkan kosong apabila tidak ada perubahan");
		# END FORM DO NOT REMOVE THIS LINE

	}

	public function getProfile() {

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;
		$this->hide_form 	  = ['id_cms_privileges','id_kode_unit'];

		$data['page_title'] = trans("crudbooster.label_button_profile");
		$data['row']        = CRUDBooster::first('cms_users',CRUDBooster::myId());
		$this->cbView('crudbooster::default.form',$data);
	}
	public function hook_before_edit(&$postdata,$id) {
		unset($postdata['password_confirmation']);
	}
	public function hook_before_add(&$postdata) {
	    unset($postdata['password_confirmation']);
    }

    public function hook_query_index(&$query) {

        if(!CRUDBooster::isSuperadmin()) { // This allows the SuperAdmin to still see himself in the list

           $query->where('cms_users.id_cms_privileges', '<>', '1'); // Adds the restriction

       }

   }
}
