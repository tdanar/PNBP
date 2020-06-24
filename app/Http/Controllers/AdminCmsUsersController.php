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
		$this->col[] = array("label"=>"Role / Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
        $this->col[] = array("label"=>"Photo","name"=>"photo","image"=>1);
        $this->col[] = array("label"=>"Kementerian / Lembaga", "name"=>"id_kode_unit","join"=>"t_ref_unit,unit");
		$this->col[] = array("label"=>"Login di","name"=>"ip_address_login");

		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array();
        $this->form[] = array("label"=>"Nama","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Username","name"=>"username",'required'=>true,'validation'=>'required|alpha_dash|min:3|unique:cms_users,username,'.CRUDBooster::getCurrentId());
        $this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());
        $this->form[] = array("label"=>"No.HP/Whatsapp","name"=>"hp","type"=>"text",'required'=>true,'validation'=>'required|numeric|unique:cms_users,hp,'.CRUDBooster::getCurrentId());
        $this->form[] = array("label"=>"Foto","name"=>"photo","type"=>"upload","help"=>"Rekomendasi resolusinya 200x200px",'validation'=>'image|max:1000','resize_width'=>90,'resize_height'=>90,'user_id'=>'profpic','upload_encrypt'=>true);
        if(!CRUDBooster::isSuperadmin()) {
        $this->form[] = array("label"=>"Role / Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name","datatable_where"=>"is_superadmin<>1 AND is_active<>0",'required'=>true);
        }else{
        $this->form[] = array("label"=>"Role / Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name","datatable_where"=>"is_active<>0",'required'=>true);
        }
        $this->form[] = array("label"=>"Kementerian / Lembaga","name"=>"id_kode_unit","type"=>"select2","datatable"=>"t_ref_unit,unit",'required'=>true);
        $this->form[] = array("label"=>"Nama Unit","name"=>"eselon","type"=>"text","required"=>true,"validation"=>"required");
        $this->form[] = array("label"=>"Jabatan","name"=>"jabatan","type"=>"text","required"=>true,"validation"=>"required");
        if(CRUDBooster::getCurrentMethod()=="getAdd"){
            $this->form[] = array("label"=>"Password","name"=>"password","type"=>"password",'required'=>true,'validation'=>'confirmed|min:8|required',"help"=>"Password minimal 8 karakter");
		    $this->form[] = array("label"=>"Konfirmasi Password",'required'=>true,"name"=>"password_confirmation","type"=>"password","help"=>"Ulangi Password di atas");
        }else{
            $this->form[] = array("label"=>"Password","name"=>"password","type"=>"password",'validation'=>'confirmed|min:8',"help"=>"Password minimal 8 karakter, biarkan kosong apabila tidak ada perubahan");
		    $this->form[] = array("label"=>"Konfirmasi Password","name"=>"password_confirmation","type"=>"password","help"=>"Ulangi Password di atas, biarkan kosong apabila tidak ada perubahan");
        }

        # END FORM DO NOT REMOVE THIS LINE

        $this->addaction[] = ['label'=>'Log Out','url'=>CRUDBooster::mainpath('set-status/logout/[id]'),'icon'=>'fa fa-lock','color'=>'danger','showIf'=>"[ip_address_login] != ''"];


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
        if(in_array($postdata['id_cms_privileges'], array(5))){
            $unit = $postdata['id_kode_unit'];
            $aidi = DB::table('cms_users')->select('id')->whereIn('id_cms_privileges',[5])->where('id_kode_unit',$unit)->first();
            $count = DB::table('cms_users')->whereIn('id_cms_privileges',[5])->where('id_kode_unit',$unit)->count();
            //dd((int)$id,$aidi->id,$count);
            if($count > 0){
                if($count != 1 || $aidi->id != (int)$id){
                    if (Request::ajax()) {
                        $res = response()->json([
                            'message' => 'Terjadi kesalahan! Sudah ada Approver di K/L yang dimaksud (Maksimal 1 Approver per K/L).',
                            'message_type' => 'warning',
                        ])->send();
                        exit;
                    } else {
                        $res = redirect()->back()->with("errors", $message)->with([
                            'message' => 'Terjadi kesalahan! Sudah ada Approver di K/L yang dimaksud (Maksimal 1 Approver per K/L).',
                            'message_type' => 'warning',
                        ])->withInput();
                        \Session::driver()->save();
                        $res->send();
                        exit;
                    }
                }

            }
        }
	}
	public function hook_before_add(&$postdata) {
        unset($postdata['password_confirmation']);
        if(in_array($postdata['id_cms_privileges'], array(5))){
            $unit = $postdata['id_kode_unit'];
            $count = DB::table('cms_users')->whereIn('id_cms_privileges',[5])->where('id_kode_unit',$unit)->count();
            if($count > 0){

                if (Request::ajax()) {
                    $res = response()->json([
                        'message' => 'Terjadi kesalahan! Sudah ada Approver di K/L yang dimaksud (Maksimal 1 Approver per K/L).',
                        'message_type' => 'warning',
                    ])->send();
                    exit;
                } else {
                    $res = redirect()->back()->with("errors", $message)->with([
                        'message' => 'Terjadi kesalahan! Sudah ada Approver di K/L yang dimaksud (Maksimal 1 Approver per K/L).',
                        'message_type' => 'warning',
                    ])->withInput();
                    \Session::driver()->save();
                    $res->send();
                    exit;
                }
            }
        }
    }

    public function getSetStatus($logout,$id) {
        DB::table('cms_users')->where('id',$id)->update(['ip_address_login'=>null,'session_id'=>null]);

        //This will redirect back and gives a message
        CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"User sudah logout!","info");
     }

    public function hook_query_index(&$query) {

        if(!CRUDBooster::isSuperadmin()) { // This allows the SuperAdmin to still see himself in the list

           $query->where('cms_users.id_cms_privileges', '<>', '1'); // Adds the restriction

       }
       if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3) { // This allows the SuperAdmin to still see himself in the list

        $query->where('cms_users.id_cms_privileges', '<>', '3'); // Adds the restriction

    }

   }
}
