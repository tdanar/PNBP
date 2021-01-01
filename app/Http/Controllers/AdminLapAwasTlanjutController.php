<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
    use CRUDBooster;
    use DataTables;

	class AdminLapAwasTlanjutController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

            $rows = DB::table('t_lap_awas_tlanjut')->where('id_rekomendasi','=',$_GET['parent_id'])->latest()->first();
            $status = $rows->status;
            //dd($rows);

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
                $this->button_add = false;
                $this->button_edit = false;
                $this->button_delete = false;
                $this->button_addmore = false;

			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t_lap_awas_tlanjut";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
            $this->col = [];
            $this->col[] = ["label"=>"Rekomendasi","name"=>"id_rekomendasi","join"=>"t_lap_awas_rekomend,rekomendasi"];
			$this->col[] = ["label"=>"Tgl","name"=>"tgl"];
			$this->col[] = ["label"=>"Progress","name"=>"progress"];
			$this->col[] = ["label"=>"Status","name"=>"status"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
            $this->form = [];
            $this->form[] = ['label'=>'Rekomendasi','name'=>'id_rekomendasi','type'=>'hidden','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
            if(CRUDBooster::myPrivilegeId() == 5){
                $this->form[] = ['label'=>'Tanggal','name'=>'tgl','type'=>'date','validation'=>'required|date','width'=>'col-sm-10', 'disabled'];
                $this->form[] = ['label'=>'Progress','name'=>'progress','type'=>'textarea','validation'=>'max:5000','width'=>'col-sm-10', 'disabled' => 'disabled'];
                $this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required','width'=>'col-sm-10','datatable'=>'t_ref_tl,deskripsi', 'disabled' => 'disabled'];
                $this->form[] = ['label'=>'Terima?','name'=>'id_status_kirim','type'=>'radio','validation'=>'required','width'=>'col-sm-10','dataenum'=>'2|Ya;4|Tidak'];
                $this->form[] = ['label'=>'Komentar','name'=>'comment','type'=>'textarea','width'=>'col-sm-10','style'=>'display: none;'];
                $this->form[] = ['label'=>'Approver','name'=>'id_user_comment','type'=>'hidden','value'=>CRUDBooster::myId(),'width'=>'col-sm-10'];
                $this->form[] = ['label'=>'Inputer','name'=>'inputer','type'=>'hidden','width'=>'col-sm-10'];
            }else{
                $this->form[] = ['label'=>'Komentar Approver','name'=>'comment','type'=>'textarea','width'=>'col-sm-10','disabled' => 'disabled'];
                $this->form[] = ['label'=>'Tanggal','name'=>'tgl','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
                $this->form[] = ['label'=>'Progress','name'=>'progress','type'=>'textarea','validation'=>'max:5000','width'=>'col-sm-10'];
                $this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required','width'=>'col-sm-10','datatable'=>'t_ref_tl,deskripsi'];
                $this->form[] = ['label'=>'Kirim ke approver?','name'=>'id_status_kirim','type'=>'radio','validation'=>'required','width'=>'col-sm-10','dataenum'=>'3|Ya;1|Tidak'];
            }


			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Tgl","name"=>"tgl","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Progress","name"=>"progress","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			# OLD END FORM

			/*
	        | ----------------------------------------------------------------------
	        | Sub Module
	        | ----------------------------------------------------------------------
			| @label          = Label of action
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        |
	        */
	        $this->sub_module = array();


	        /*
	        | ----------------------------------------------------------------------
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        |
	        */
	        $this->addaction = array();


	        /*
	        | ----------------------------------------------------------------------
	        | Add More Button Selected
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button
	        | Then about the action, you should code at actionButtonSelected method
	        |
	        */
	        $this->button_selected = array();


	        /*
	        | ----------------------------------------------------------------------
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------
	        | @message = Text of message
	        | @type    = warning,success,danger,info
	        |
	        */
	        $this->alert        = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add more button to header button
	        | ----------------------------------------------------------------------
	        | @label = Name of button
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        |
	        */
	        //$this->index_button = array();
            $this->index_button[] = ['label'=>'Export ke Excel','url'=>'#','icon'=>'fa fa-download','indexonly' => 'false'];
            $this->index_button[] = ['label'=>'Refresh Tabel','url'=>'/ma/lap_awas_tlanjut','icon'=>'fa fa-table','indexonly' => 'false'];


	        /*
	        | ----------------------------------------------------------------------
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
	        |
	        */
	        $this->table_row_color = array();


	        /*
	        | ----------------------------------------------------------------------
	        | You may use this bellow array to add statistic at dashboard
	        | ----------------------------------------------------------------------
	        | @label, @count, @icon, @color
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add javascript at body
	        | ----------------------------------------------------------------------
	        | javascript code in the variable
	        | $this->script_js = "function() { ... }";
	        |
            */
            if(CRUDBooster::myPrivilegeId() == 5){
                $this->script_js =
                '$(document).ready(function(){

                    $("input[name$=id_status_kirim]").click(function() {
                    var test = $(this).val();

                    if(test == 4){
                        $("#form-group-comment").show();
                    }else{
                        $("#form-group-comment").hide();
                    }
                });
                });';
            }



            /*
	        | ----------------------------------------------------------------------
	        | Include HTML Code before index table
	        | ----------------------------------------------------------------------
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;



	        /*
	        | ----------------------------------------------------------------------
	        | Include HTML Code after index table
	        | ----------------------------------------------------------------------
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;



	        /*
	        | ----------------------------------------------------------------------
	        | Include Javascript File
	        | ----------------------------------------------------------------------
	        | URL of your javascript each array
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add css style at body
	        | ----------------------------------------------------------------------
	        | css code in the variable
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;



	        /*
	        | ----------------------------------------------------------------------
	        | Include css File
	        | ----------------------------------------------------------------------
	        | URL of your css each array
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();


	    }


	    /*
	    | ----------------------------------------------------------------------
	    | Hook for button selected
	    | ----------------------------------------------------------------------
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here

	    }


	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate query of index result
	    | ----------------------------------------------------------------------
	    | @query = current sql query
	    |
	    */
	    public function hook_query_index(&$query) {
            //Your code here
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate row of index table html
	    | ----------------------------------------------------------------------
	    |
	    */
	    public function hook_row_index($column_index,&$column_value) {
            //Your code here
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before add data is execute
	    | ----------------------------------------------------------------------
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {
            //Your code here
            // $id = $postdata['id_rekomendasi'];
            // $tgl_tl = $postdata['tgl'];
            // $tl = $postdata['progress'];
            // $id_kod_tl = $postdata['status'];
            // DB::table('t_lap_awas_rekomend')
            // ->where('id',$id)
            // ->update(['tgl_tl'=>$tgl_tl,'tl'=>$tl,'id_kod_tl'=>$id_kod_tl]);
            $postdata['inputer'] = CRUDBooster::myId();
            $id_rekomend = $postdata['id_rekomendasi'];
            $id_status_kirim = $postdata['id_status_kirim'];
            DB::table('t_lap_awas_rekomend')
                ->where('id',$id_rekomend)
                ->update(['id_status_kirim' => $id_status_kirim,'updated_at'=>now()]);



	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after add public static function called
	    | ----------------------------------------------------------------------
	    | @id = last insert id
	    |
	    */
	    public function hook_after_add($id) {
            //Your code here
            $id_rekomend = DB::table('t_lap_awas_rekomend')->select('t_lap_awas_rekomend.id')->leftjoin('t_lap_awas_tlanjut','t_lap_awas_tlanjut.id_rekomendasi','=','t_lap_awas_rekomend.id')->where('t_lap_awas_tlanjut.id',$id)->first()->id;
            $tlanjut = DB::table('t_lap_awas_tlanjut')->selectRaw('t_lap_awas_tlanjut.*,cms_users.name,cms_users.id_cms_privileges,cms_users.id_kode_unit')->leftjoin('cms_users','cms_users.id','=','t_lap_awas_tlanjut.inputer')->where('t_lap_awas_tlanjut.id',$id)->first();
            $project = DB::table('t_lap_awas')->selectRaw('t_lap_awas.*')->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                        join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('t_lap_awas_rekomend.id',$id_rekomend)->first();

            $tosend = DB::table('cms_users')->select('id')->where('id_cms_privileges',5)->where('id_kode_unit',$tlanjut->id_kode_unit)->first()->id;



            if($tlanjut->id_status_kirim == 3){
                try {
                    $config = [];
                    $config['content'] = "[TL Dikirim] ".$tlanjut->name." telah mengirimkan progress tindak lanjut, harap untuk melakukan reviu.";
                    $config['to'] = CRUDBooster::adminPath('lap_awas_tlanjut')."?no_lap=".$project->no_lap;
                    $config['id_cms_users'] = [$tosend];

                    //dd($config);
                    DB::table('t_lap_awas_tlanjut')
                        ->where('id', $id)
                        ->update(['id_status_kirim' => 3,'comment'=>null, 'id_user_comment' => null, 'updated_at' => now()]);
                    DB::table('t_lap_awas_rekomend')
                        ->where('id', $id_rekomend)
                        ->update(['last_id_tl' => $id, 'id_status_kirim' => 3,'comment'=>null, 'id_user_comment' => null, 'updated_at' => now()]);
                        CRUDBooster::sendNotification($config);
                return redirect('/ma/lap_awas_tlanjut')->with('status','Progress tindak lanjut telah berhasil dikirim!');
                } catch (Exception $e) {
                    report ($e);
                    return false;
                }
            }else{
                DB::table('t_lap_awas_rekomend')
                ->where('id',$id_rekomend)
                ->update(['last_id_tl' => $id]);
            }


	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before update data is execute
	    | ----------------------------------------------------------------------
	    | @postdata = input post data
	    | @id       = current id
	    |
	    */
	    public function hook_before_edit(&$postdata,$id) {
            //Your code here
            $reference = DB::table('t_lap_awas_tlanjut')->where('id',$id)->first();
            $id_rekomend = $postdata['id_rekomendasi'];
            $choice = $postdata['id_status_kirim'];
            $id_status_kirim = $postdata['id_status_kirim'];
            $comment = $postdata['comment'];
            $id_user_comment = $postdata['id_user_comment'];
            $inputer = $postdata['inputer'];
            $tlanjut = DB::table('t_lap_awas_tlanjut')->selectRaw('t_lap_awas_tlanjut.*,cms_users.name,cms_users.id_cms_privileges,cms_users.id_kode_unit')->leftjoin('cms_users','cms_users.id','=','t_lap_awas_tlanjut.id_user_comment')->where('t_lap_awas_tlanjut.id',$id)->first();
            $tlanjut2 = DB::table('t_lap_awas_tlanjut')->selectRaw('t_lap_awas_tlanjut.*,cms_users.name,cms_users.id_cms_privileges,cms_users.id_kode_unit')->leftjoin('cms_users','cms_users.id','=','t_lap_awas_tlanjut.inputer')->where('t_lap_awas_tlanjut.id',$id)->first();
            $project = DB::table('t_lap_awas')->selectRaw('t_lap_awas.*')->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('t_lap_awas_rekomend.id',$id_rekomend)->first();
            $tosend = DB::table('cms_users')->select('id')->where('id_cms_privileges',5)->where('id_kode_unit',$tlanjut->id_kode_unit)->first()->id;

            if($choice == 2){

                    $config = [];
                    $config['content'] = "[TL Diterima] Approver ".$tlanjut->name." telah menerima dan mengirimkan progress tindak lanjut ke Kemenkeu.";
                    $config['to'] = CRUDBooster::adminPath('lap_awas_tlanjut')."?no_lap=".$project->no_lap;
                    $config['id_cms_users'] = [$inputer];

                    DB::table('t_lap_awas_rekomend')
                    ->where('id',$id_rekomend)
                    ->update(['tgl_tl' => $reference->tgl,'tl' => $reference->progress, 'id_kod_tl' => $reference->status, 'comment' => null, 'id_user_comment' => null, 'id_status_kirim' => $choice, 'updated_at' => now()]);
                    $postdata['progress'] = $reference->progress;
                    $postdata['status'] = $reference->status;

                    CRUDBooster::sendNotification($config);

            }elseif($choice == 3){

                    $config = [];
                    $config['content'] = "[TL Dikirim] ".$tlanjut2->name." telah mengirimkan progress tindak lanjut, harap untuk melakukan reviu.";
                    $config['to'] = CRUDBooster::adminPath('lap_awas_tlanjut')."?no_lap=".$project->no_lap;
                    $config['id_cms_users'] = [$tosend];

                    DB::table('t_lap_awas_rekomend')
                    ->where('id',$id_rekomend)
                    ->update(['id_status_kirim'=>$choice, 'comment'=>null, 'id_user_comment' => null, 'updated_at' => now()]);
                    CRUDBooster::sendNotification($config);

            }elseif($choice == 1){
                DB::table('t_lap_awas_rekomend')
                ->where('id',$id_rekomend)
                ->update(['id_status_kirim'=>$choice, 'comment'=>null, 'id_user_comment' => null, 'updated_at' => now()]);
            }else{

                    $config = [];
                    $config['content'] = "[TL Ditolak] Approver ".$tlanjut->name." telah menolak progress tindak lanjut, silahkan diperbaiki.";
                    $config['to'] = CRUDBooster::adminPath('lap_awas_tlanjut')."?no_lap=".$project->no_lap;
                    $config['id_cms_users'] = [$inputer];
                    $postdata['progress'] = $reference->progress;
                    $postdata['status'] = $reference->status;

                    DB::table('t_lap_awas_rekomend')
                    ->where('id',$id_rekomend)
                    ->update(['comment'=>$comment, 'id_user_comment'=>$id_user_comment, 'id_status_kirim'=>$id_status_kirim, 'updated_at' => now()]);
                    CRUDBooster::sendNotification($config);

            }

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_edit($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }

        public function KirimTL($id)
        {
            $id_tlanjut = DB::table('t_lap_awas_rekomend')->selectRaw('t_lap_awas_tlanjut.id')->leftjoin('t_lap_awas_tlanjut','t_lap_awas_tlanjut.id_rekomendasi','=','t_lap_awas_rekomend.id')->orderBy('t_lap_awas_tlanjut.id','desc')->first()->id;
            $tlanjut = DB::table('t_lap_awas_tlanjut')->selectRaw('t_lap_awas_tlanjut.*,cms_users.name,cms_users.id_cms_privileges,cms_users.id_kode_unit')->leftjoin('cms_users','cms_users.id','=','t_lap_awas_tlanjut.inputer')->where('t_lap_awas_tlanjut.id',$id_tlanjut)->first();
            $project = DB::table('t_lap_awas')->selectRaw('t_lap_awas.*')->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                        join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('t_lap_awas_rekomend.id',$id)->first();
            $tosend = DB::table('cms_users')->select('id')->where('id_cms_privileges',5)->where('id_kode_unit',$tlanjut->id_kode_unit)->first()->id;
            //dd($id_tlanjut, $tlanjut, $project, $tosend);
            try {
                $config = [];
                $config['content'] = "[TL Dikirim] ".$tlanjut->name." telah mengirimkan progress tindak lanjut, harap untuk melakukan reviu.";
                $config['to'] = CRUDBooster::adminPath('lap_awas_tlanjut')."?no_lap=".$project->no_lap;
                $config['id_cms_users'] = [$tosend];

                //dd($config);
                DB::table('t_lap_awas_tlanjut')
                    ->where('id', $id_tlanjut)
                    ->update(['id_status_kirim' => 3,'comment'=>null, 'id_user_comment' => null, 'updated_at' => now()]);
                DB::table('t_lap_awas_rekomend')
                    ->where('id', $id)
                    ->update(['id_status_kirim' => 3,'comment'=>null, 'id_user_comment' => null, 'updated_at' => now()]);
                    CRUDBooster::sendNotification($config);
            return redirect('/ma/lap_awas_tlanjut')->with('status','Progress tindak lanjut telah berhasil dikirim!');
            } catch (Exception $e) {
                report ($e);
                return false;
            }
        }

        public function getIndex() {
            //First, Add an auth
             if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

             //Create your own query
             $data = [];
             if(CRUDBooster::myPrivilegeId() == 2 || CRUDBooster::myPrivilegeId() == 5){
                $data['page_title'] = 'Monitoring TL Pengawasan PNBP : '.CRUDBooster::myUnit();
            }else{
                $data['page_title'] = 'Monitoring TL Pengawasan PNBP';
            }

             if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeId() == 3){
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
                `t_lap_awas`.`no_lap`,
                `t_lap_awas`.`tanggal`,
                `t_lap_awas`.`nama_giat_was`,
                `t_lap_awas`.`id`,
                `t_lap_awas_rekomend`.`id_status_kirim`,
                `t_lap_awas`.`thn_mulai`,
                `t_lap_awas`.`thn_usai`,
                `t_ref_jenis_awas`.`jenis_awas`,
                `t_lap_awas`.`created_at`,
                `t_lap_awas`.`updated_at`,
                `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
                `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
                `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                `t_lap_awas_temuan`.`id` AS `id_temuan`,
                `t_lap_awas_temuan`.`judul`,
                `t_lap_awas_temuan`.`kondisi`,
                `t_lap_awas_temuan`.`sebab`,
                `t_lap_awas_temuan`.`akibat`,
                `t_ref_matauang`.`kode` AS `KodeMatauang`,
                `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
                `t_ref_statkirim`.`status` AS `StatKirim`,
                `t_lap_awas_temuan`.`nilai_uang`,
                `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
                `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                `t_ref_tl`.`deskripsi` AS `KodTL`,
                `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                `t_lap_awas_rekomend`.`status_tl`,
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                orderby('id','desc')->
                get();
             }else if(CRUDBooster::myPrivilegeId() == 4){
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
                `t_lap_awas`.`no_lap`,
                `t_lap_awas`.`tanggal`,
                `t_lap_awas`.`nama_giat_was`,
                `t_lap_awas`.`id`,
                `t_lap_awas_rekomend`.`id_status_kirim`,
                `t_lap_awas`.`thn_mulai`,
                `t_lap_awas`.`thn_usai`,
                `t_ref_jenis_awas`.`jenis_awas`,
                `t_lap_awas`.`created_at`,
                `t_lap_awas`.`updated_at`,
                `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
                `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
                `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                `t_lap_awas_temuan`.`id` AS `id_temuan`,
                `t_lap_awas_temuan`.`judul`,
                `t_lap_awas_temuan`.`kondisi`,
                `t_lap_awas_temuan`.`sebab`,
                `t_lap_awas_temuan`.`akibat`,
                `t_ref_matauang`.`kode` AS `KodeMatauang`,
                `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
                `t_ref_statkirim`.`status` AS `StatKirim`,
                `t_lap_awas_temuan`.`nilai_uang`,
                `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
                `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                `t_ref_tl`.`deskripsi` AS `KodTL`,
                `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                `t_lap_awas_rekomend`.`status_tl`,
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                where('id_status_kirim',2)->
                orderby('id','desc')->
                get();
             }else if(CRUDBooster::myPrivilegeId() == 5){
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
                `t_lap_awas`.`no_lap`,
                `t_lap_awas`.`tanggal`,
                `t_lap_awas`.`nama_giat_was`,
                `t_lap_awas`.`id`,
                `t_lap_awas_rekomend`.`id_status_kirim`,
                `t_lap_awas`.`thn_mulai`,
                `t_lap_awas`.`thn_usai`,
                `t_ref_jenis_awas`.`jenis_awas`,
                `t_lap_awas`.`created_at`,
                `t_lap_awas`.`updated_at`,
                `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
                `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
                `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                `t_lap_awas_temuan`.`id` AS `id_temuan`,
                `t_lap_awas_temuan`.`judul`,
                `t_lap_awas_temuan`.`kondisi`,
                `t_lap_awas_temuan`.`sebab`,
                `t_lap_awas_temuan`.`akibat`,
                `t_ref_matauang`.`kode` AS `KodeMatauang`,
                `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
                `t_ref_statkirim`.`status` AS `StatKirim`,
                `t_lap_awas_temuan`.`nilai_uang`,
                `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
                `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                `t_ref_tl`.`deskripsi` AS `KodTL`,
                `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                `t_lap_awas_rekomend`.`status_tl`,
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                where('unit',CRUDBooster::myUnit())->
                orderby('id','desc')->
                get();
             }else{
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
                `t_lap_awas`.`no_lap`,
                `t_lap_awas`.`tanggal`,
                `t_lap_awas`.`nama_giat_was`,
                `t_lap_awas`.`id`,
                `t_lap_awas_rekomend`.`id_status_kirim`,
                `t_lap_awas`.`thn_mulai`,
                `t_lap_awas`.`thn_usai`,
                `t_ref_jenis_awas`.`jenis_awas`,
                `t_lap_awas`.`created_at`,
                `t_lap_awas`.`updated_at`,
                `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
                `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
                `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                `t_lap_awas_temuan`.`id` AS `id_temuan`,
                `t_lap_awas_temuan`.`judul`,
                `t_lap_awas_temuan`.`kondisi`,
                `t_lap_awas_temuan`.`sebab`,
                `t_lap_awas_temuan`.`akibat`,
                `t_ref_matauang`.`kode` AS `KodeMatauang`,
                `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
                `t_ref_statkirim`.`status` AS `StatKirim`,
                `t_lap_awas_temuan`.`nilai_uang`,
                `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
                `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                `t_ref_tl`.`deskripsi` AS `KodTL`,
                `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                `t_lap_awas_rekomend`.`status_tl`,
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                where('id_user',CRUDBooster::myId())->orderby('id','desc')->
                get();
             }


            //dd($data);

             //Create a view. Please use `cbView` method instead of view method from laravel.
             $this->cbView('lapTLanjut',$data);
    }




    public function getEdit($id)
    {
        $this->button_addmore = FALSE;
		$this->button_cancel  = TRUE;
		$this->button_show    = FALSE;
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;
        $this->hide_form 	  = [];




        if(CRUDBooster::myPrivilegeId() == 5){
           $data['page_title'] = 'Reviu Tindak Lanjut dari Inputer';
        }else{
            $data['page_title'] = 'Edit Tindak Lanjut';
        }

        $data['row']        = CRUDBooster::first('t_lap_awas_tlanjut',$id);

        $data['command']    = 'edit';


		$this->cbView('crudbooster::default.form',$data);
    }

    public function getDataWas() {
        if(Session::has('admin_id')){
        if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeId() == 3){
            $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
            `cms_users`.`name` AS `inputer`,
            `t_lap_awas`.`tahun`,
            `t_ref_unit`.`unit`,
            `t_lap_awas`.`no_lap`,
            `t_lap_awas`.`tanggal`,
            `t_lap_awas`.`nama_giat_was`,
            `t_lap_awas`.`id`,
            `t_lap_awas_rekomend`.`id_status_kirim`,
            `t_lap_awas`.`thn_mulai`,
            `t_lap_awas`.`thn_usai`,
            `t_ref_jenis_awas`.`jenis_awas`,
            `t_lap_awas`.`created_at`,
            `t_lap_awas`.`updated_at`,
            `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
            `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
            `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
            `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
            `t_lap_awas_temuan`.`id` AS `id_temuan`,
            `t_lap_awas_temuan`.`judul`,
            `t_lap_awas_temuan`.`kondisi`,
            `t_lap_awas_temuan`.`sebab`,
            `t_lap_awas_temuan`.`akibat`,
            `t_ref_matauang`.`kode` AS `KodeMatauang`,
            `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
            `t_ref_statkirim`.`status` AS `StatKirim`,
            `t_lap_awas_temuan`.`nilai_uang`,
            `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
            `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
            `t_ref_tl`.`deskripsi` AS `KodTL`,
            `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
            `t_lap_awas_rekomend`.`status_tl`,
            `t_lap_awas_rekomend`.`tl`,
            `t_lap_awas_rekomend`.`rekomendasi`')->
            leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
            leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
            leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
            leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
            leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
            leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
            leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
            orderby('id','desc')->
            get()->toArray();
            // $data['recordsTotal'] = $data['data']->count();
            // $data['recordsFiltered'] = $data['data']->count();
            // $data['draw'] = 1;
        }
        else if(CRUDBooster::myPrivilegeId() == 4){
            $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
            `cms_users`.`name` AS `inputer`,
            `t_lap_awas`.`tahun`,
            `t_ref_unit`.`unit`,
            `t_lap_awas`.`no_lap`,
            `t_lap_awas`.`tanggal`,
            `t_lap_awas`.`nama_giat_was`,
            `t_lap_awas`.`id`,
            `t_lap_awas_rekomend`.`id_status_kirim`,
            `t_lap_awas`.`thn_mulai`,
            `t_lap_awas`.`thn_usai`,
            `t_ref_jenis_awas`.`jenis_awas`,
            `t_lap_awas`.`created_at`,
            `t_lap_awas`.`updated_at`,
            `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
            `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
            `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
            `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
            `t_lap_awas_temuan`.`id` AS `id_temuan`,
            `t_lap_awas_temuan`.`judul`,
            `t_lap_awas_temuan`.`kondisi`,
            `t_lap_awas_temuan`.`sebab`,
            `t_lap_awas_temuan`.`akibat`,
            `t_ref_matauang`.`kode` AS `KodeMatauang`,
            `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
            `t_ref_statkirim`.`status` AS `StatKirim`,
            `t_lap_awas_temuan`.`nilai_uang`,
            `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
            `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
            `t_ref_tl`.`deskripsi` AS `KodTL`,
            `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
            `t_lap_awas_rekomend`.`status_tl`,
            `t_lap_awas_rekomend`.`tl`,
            `t_lap_awas_rekomend`.`rekomendasi`')->
            leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
            leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
            leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
            leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
            leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
            leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
            leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
            orderby('id','desc')->
            where('id_status_kirim',2)->
            get()->toArray();
            // $data['recordsTotal'] = $data['data']->count();
            // $data['recordsFiltered'] = $data['data']->count();
            // $data['draw'] = 1;
        }
        else if(CRUDBooster::myPrivilegeId() == 5){
            $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
            `cms_users`.`name` AS `inputer`,
            `t_lap_awas`.`tahun`,
            `t_ref_unit`.`unit`,
            `t_lap_awas`.`no_lap`,
            `t_lap_awas`.`tanggal`,
            `t_lap_awas`.`nama_giat_was`,
            `t_lap_awas`.`id`,
            `t_lap_awas_rekomend`.`id_status_kirim`,
            `t_lap_awas`.`thn_mulai`,
            `t_lap_awas`.`thn_usai`,
            `t_ref_jenis_awas`.`jenis_awas`,
            `t_lap_awas`.`created_at`,
            `t_lap_awas`.`updated_at`,
            `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
            `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
            `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
            `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
            `t_lap_awas_temuan`.`id` AS `id_temuan`,
            `t_lap_awas_temuan`.`judul`,
            `t_lap_awas_temuan`.`kondisi`,
            `t_lap_awas_temuan`.`sebab`,
            `t_lap_awas_temuan`.`akibat`,
            `t_ref_matauang`.`kode` AS `KodeMatauang`,
            `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
            `t_ref_statkirim`.`status` AS `StatKirim`,
            `t_lap_awas_temuan`.`nilai_uang`,
            `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
            `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
            `t_ref_tl`.`deskripsi` AS `KodTL`,
            `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
            `t_lap_awas_rekomend`.`status_tl`,
            `t_lap_awas_rekomend`.`tl`,
            `t_lap_awas_rekomend`.`rekomendasi`')->
            leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
            leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
            leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
            leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
            leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
            leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
            leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
            where('unit',CRUDBooster::myUnit())->orderby('id','desc')->
            get()->toArray();
        }
        else{
            $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
            `cms_users`.`name` AS `inputer`,
            `t_lap_awas`.`tahun`,
            `t_ref_unit`.`unit`,
            `t_lap_awas`.`no_lap`,
            `t_lap_awas`.`tanggal`,
            `t_lap_awas`.`nama_giat_was`,
            `t_lap_awas`.`id`,
            `t_lap_awas_rekomend`.`id_status_kirim`,
            `t_lap_awas`.`thn_mulai`,
            `t_lap_awas`.`thn_usai`,
            `t_ref_jenis_awas`.`jenis_awas`,
            `t_lap_awas`.`created_at`,
            `t_lap_awas`.`updated_at`,
            `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
            `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
            `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
            `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
            `t_lap_awas_temuan`.`id` AS `id_temuan`,
            `t_lap_awas_temuan`.`judul`,
            `t_lap_awas_temuan`.`kondisi`,
            `t_lap_awas_temuan`.`sebab`,
            `t_lap_awas_temuan`.`akibat`,
            `t_ref_matauang`.`kode` AS `KodeMatauang`,
            `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
            `t_ref_statkirim`.`status` AS `StatKirim`,
            `t_lap_awas_temuan`.`nilai_uang`,
            `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
            `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
            `t_ref_tl`.`deskripsi` AS `KodTL`,
            `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
            `t_lap_awas_rekomend`.`status_tl`,
            `t_lap_awas_rekomend`.`tl`,
            `t_lap_awas_rekomend`.`rekomendasi`')->
            leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
            leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
            leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
            leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
            leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
            leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
            leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
            where('id_user',CRUDBooster::myId())->orderby('id','desc')->
            get()->toArray();

            }
            $count = count(array_unique(array_column($data, 'id')));
            $datas = array_values(collect($data)->sortByDesc('id')->toArray());


            for($i=0; $i < count($datas); $i++){
                $datas[0]->urutan = 1;
                if($datas[$i]->id === $datas[$i-1]->id){
                    $datas[$i]->urutan = $datas[$i-1]->urutan;
                }else{
                    $datas[$i]->urutan = $datas[$i-1]->urutan + 1;
                }

            }

            return Datatables::of($datas)->make(true);

        }else{
            CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
        };

    }

    public function getTlanjut($id){
//First, Add an auth
         if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

         //Create your own query
         $detail = [];
         $detail['page_title'] = 'Laporan Pengawasan PNBP';
         $detail['first'] = DB::table('t_lap_awas')->selectRaw('
         `t_lap_awas`.`id`,
         `cms_users`.`name` AS `inputer`,
         `t_lap_awas`.`tahun`,
         `t_lap_awas`.`no_lap`,
         `t_lap_awas`.`tanggal`,
         `t_lap_awas`.`nama_giat_was`,
         `t_lap_awas`.`id_status_kirim`,
         `t_ref_statkirim`.`status` AS `StatKirim`,
         `t_lap_awas`.`thn_mulai`,
         `t_lap_awas`.`thn_usai`,
         `t_lap_awas`.`filename`,
         substring_index(`t_lap_awas`.`filename`, "/", -1) AS namafile,
         `t_ref_jenis_awas`.`jenis_awas`,
         `t_lap_awas`.`created_at`,
         `t_lap_awas`.`updated_at`')->
         join('cms_users','t_lap_awas.id_user','=','cms_users.id')->
         join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
         join('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
         where('t_lap_awas.id',$id)->first();

        $detail['second'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
            `t_lap_awas`.`id`,
            `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
            `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
            `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
            `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
            `t_lap_awas_temuan`.`id` AS `id_temuan`,
            `t_lap_awas_temuan`.`judul`,
            `t_lap_awas_temuan`.`lokasi`,
            `t_lap_awas_temuan`.`kondisi`,
            `t_lap_awas_temuan`.`sebab`,
            `t_lap_awas_temuan`.`akibat`,
            `t_ref_matauang`.`kode` AS `KodeMatauang`,
            `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
            `t_lap_awas_temuan`.`nilai_uang`')->
            leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            where('t_lap_awas_temuan.id_lap',$id)->get();

            $detail['third'] = DB::table('t_lap_awas')->selectRaw('
            `t_lap_awas`.`id`,
            `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
            `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
            `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
            `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
            `t_lap_awas_temuan`.`id` AS `id_temuan`,
            `t_lap_awas_temuan`.`judul`,
            `t_lap_awas_temuan`.`kondisi`,
            `t_lap_awas_temuan`.`sebab`,
            `t_lap_awas_temuan`.`akibat`,
            `t_ref_matauang`.`kode` AS `KodeMatauang`,
            `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
            `t_ref_statkirim`.`status` AS `StatKirim`,
            `t_lap_awas_temuan`.`nilai_uang`,
            `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
            `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
            `t_ref_tl`.`deskripsi` AS `KodTL`,
            `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
            `t_lap_awas_rekomend`.`status_tl`,
            `t_lap_awas_rekomend`.`tgl_tl`,
            `t_lap_awas_rekomend`.`tl`,
            `t_lap_awas_rekomend`.`last_id_tl`,
            `t_lap_awas_rekomend`.`id_status_kirim` AS `id_kirim_TL`,
            `t_lap_awas_rekomend`.`comment` AS `comment_TL`,
            `t_lap_awas_rekomend`.`rekomendasi`')->
            leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
            leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
            leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
            leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            join('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
            leftjoin('t_ref_statkirim','t_lap_awas_rekomend.id_status_kirim','=','t_ref_statkirim.id')->
            where('t_lap_awas.id',$id)->get();

            $detail['countTemuan'] = DB::table('t_lap_awas_temuan')->where('id_lap',$id)->count();
            $detail['countRekomend'] = DB::table('t_lap_awas_rekomend')->join('t_lap_awas_temuan','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('id_lap',$id)->count();


        //dd($detail);

         //Create a view. Please use `cbView` method instead of view method from laravel.
            $this->cbView('modal.tlanjut',$detail);
        }


    }


