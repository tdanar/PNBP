<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

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

			$this->button_detail = true;
			$this->button_show = true;
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
            $this->form[] = ['label'=>'Rekomendasi','name'=>'id_rekomendasi','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_lap_awas_rekomend,rekomendasi'];
			$this->form[] = ['label'=>'Tgl','name'=>'tgl','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Progress','name'=>'progress','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required','width'=>'col-sm-10','dataenum'=>'Dalam Proses;Tuntas'];
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
	        $this->index_button = array();



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
	        $this->script_js = NULL;


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



	    public function getIndex()
        {
            //First, Add an auth
            if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

            //Create your own query

            $input = [];
            $input['tahun'] = $_GET['tahun'];
            $input['unit'] = $_GET['unit'];
            $input['jenis_was'] = $_GET['jenis_was'];
            $input['statusKirim'] = $_GET['statusKirim'];
            $input['klasTemuan'] = $_GET['klasTemuan'];
            $input['DeskTemuan'] = $_GET['klasTemuan'] == ''?'': $this->getTemuan($_GET['klasTemuan']);
            $input['klasSebab'] = $_GET['klasSebab'];
            $input['DeskSebab'] = $_GET['klasSebab'] == ''?'': $this->getSebab($_GET['klasSebab']);
            $input['klasRek'] = $_GET['klasRek'];
            $input['DeskRek'] = $_GET['klasRek'] == ''?'': $this->getRek($_GET['klasRek']);
            $input['KodTL'] = $_GET['KodTL'];



            $filters = [
                't_lap_awas.tahun' => 'tahun',
                't_ref_unit.unit' => 'unit',
                't_ref_jenis_awas.jenis_awas' => 'jenis_was',
                't_ref_statkirim.status' => 'statusKirim',
                't_ref_kod_temuan.id_up2' => 'klasTemuan',
                't_ref_kod_sebab.Id_up_sebab' => 'klasSebab',
                't_ref_kod_rekomendasi.id' => 'klasRek',
                't_ref_tl.deskripsi' => 'KodTL'
            ];
            $data = [];
            $data['page_title'] = 'Monitoring Pengawasan PNBP';
            $data['input'] = collect($input);
            if(in_array(CRUDBooster::myPrivilegeId(),array(4))){
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_ref_unit`.`unit`,
                `t_ref_unit`.`id` AS `id_unit`,
                `t_lap_awas`.`tahun`,
                `t_lap_awas`.`id`,
                `t_lap_awas`.`id_status_kirim`,
                `t_ref_jenis_awas`.`jenis_awas`,
                `t_lap_awas_temuan`.`id` AS `id_temuan`,
                `t_ref_kod_temuan1`.`id` AS `IdKlasTemuan`,
                `t_ref_kod_temuan1`.`Deskripsi` AS `KlasTemuan`,
                `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                `t_ref_kod_sebab1`.`id` AS `IdKlasSebab`,
                `t_ref_kod_sebab1`.`Deskripsi` AS `KlasSebab`,
                `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                `t_ref_kod_rekomendasi`.`id` AS `IdKlasRekomendasi`,
                `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                `t_ref_tl`.`deskripsi` AS `KodTL`,
                `t_ref_statkirim`.`status` AS `statusKirim`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('cms_users','t_lap_awas.id_user','=','cms_users.id')->
                leftjoin('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')->
                leftjoin('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')->
                leftjoin('t_ref_kod_sebab AS t_ref_kod_sebab1','t_ref_kod_sebab.Id_up_sebab','=','t_ref_kod_sebab1.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                where('id_status_kirim',2)->orderby('unit','asc')->
                get();
                $data['indexWas'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                        `t_ref_unit`.`id` AS `id_unit`,
                        `t_ref_unit`.`unit` AS `unit`,
                        `t_ref_jenis_awas`.`jenis_awas` AS `jenis_awas`,
                        count(DISTINCT `t_lap_awas`.`id`) AS `jml_pengawasan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where('t_lap_awas.id_status_kirim',2)
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->orderby('unit','asc')
                ->groupBy('ID','t_ref_unit.id','t_ref_unit.unit','t_ref_jenis_awas.jenis_awas')
                ->get();
                $data['indexTemuan'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(DISTINCT `t_lap_awas_temuan`.`id`) AS `jml_temuan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where('t_lap_awas.id_status_kirim',2)
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->groupBy('ID')
                ->get();
                $data['indexRekomend'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(`t_lap_awas_rekomend`.`id`) AS `jml_rekomendasi`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where('t_lap_awas.id_status_kirim',2)
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->groupBy('ID')
                ->get();


                foreach($data['indexWas'] as $was){
                    $was->jml_temuan = $data['indexTemuan']->where('ID',$was->ID)->first()->jml_temuan;
                    $was->jml_rekomendasi = $data['indexRekomend']->where('ID',$was->ID)->first()->jml_rekomendasi;
                    $collect[] = $was;
                }

                //dd($data['klasTemuan']);

                if($collect != null){
                    for($i=0; $i < count($collect); $i++){
                    $collect[0]->urutan = 1;
                    if($collect[$i]->id_unit === $collect[$i-1]->id_unit){
                        $collect[$i]->urutan = $collect[$i-1]->urutan;
                    }else{
                        $collect[$i]->urutan = $collect[$i-1]->urutan + 1;
                    }

                }
                }
                $data['collection'] = $collect;
                //dd($collect);
            }else if(in_array(CRUDBooster::myPrivilegeId(),array(2,5))){
                $unit_id = CRUDBooster::myUnitId();
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_ref_unit`.`unit`,
                `t_ref_unit`.`id` AS `id_unit`,
                `t_lap_awas`.`tahun`,
                `t_lap_awas`.`id`,
                `t_lap_awas`.`id_status_kirim`,
                `t_ref_jenis_awas`.`jenis_awas`,
                `t_lap_awas_temuan`.`id` AS `id_temuan`,
                `t_ref_kod_temuan1`.`id` AS `IdKlasTemuan`,
                `t_ref_kod_temuan1`.`Deskripsi` AS `KlasTemuan`,
                `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                `t_ref_kod_sebab1`.`id` AS `IdKlasSebab`,
                `t_ref_kod_sebab1`.`Deskripsi` AS `KlasSebab`,
                `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                `t_ref_kod_rekomendasi`.`id` AS `IdKlasRekomendasi`,
                `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                `t_ref_tl`.`deskripsi` AS `KodTL`,
                `t_ref_statkirim`.`status` AS `statusKirim`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('cms_users','t_lap_awas.id_user','=','cms_users.id')->
                leftjoin('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')->
                leftjoin('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')->
                leftjoin('t_ref_kod_sebab AS t_ref_kod_sebab1','t_ref_kod_sebab.Id_up_sebab','=','t_ref_kod_sebab1.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                where('t_ref_unit.id',$unit_id)->orderby('t_ref_unit.unit','asc')->
                get();
                $data['indexWas'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                        `t_ref_unit`.`id` AS `id_unit`,
                        `t_ref_unit`.`unit` AS `unit`,
                        `t_ref_jenis_awas`.`jenis_awas` AS `jenis_awas`,
                        count(DISTINCT `t_lap_awas`.`id`) AS `jml_pengawasan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where('t_ref_unit.id',$unit_id)->orderby('t_ref_unit.unit','asc')
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->orderby('unit','asc')
                ->groupBy('ID','t_ref_unit.id','t_ref_unit.unit','t_ref_jenis_awas.jenis_awas')
                ->get();
                $data['indexTemuan'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(DISTINCT `t_lap_awas_temuan`.`id`) AS `jml_temuan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where('t_ref_unit.id',$unit_id)->orderby('t_ref_unit.unit','asc')
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->groupBy('ID')
                ->get();
                $data['indexRekomend'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(`t_lap_awas_rekomend`.`id`) AS `jml_rekomendasi`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where('t_ref_unit.id',$unit_id)->orderby('t_ref_unit.unit','asc')
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->groupBy('ID')
                ->get();


                foreach($data['indexWas'] as $was){
                    $was->jml_temuan = $data['indexTemuan']->where('ID',$was->ID)->first()->jml_temuan;
                    $was->jml_rekomendasi = $data['indexRekomend']->where('ID',$was->ID)->first()->jml_rekomendasi;
                    $collect[] = $was;
                }

                //dd($data['klasTemuan']);

                if($collect != null){
                    for($i=0; $i < count($collect); $i++){
                    $collect[0]->urutan = 1;
                    if($collect[$i]->id_unit === $collect[$i-1]->id_unit){
                        $collect[$i]->urutan = $collect[$i-1]->urutan;
                    }else{
                        $collect[$i]->urutan = $collect[$i-1]->urutan + 1;
                    }

                }
                }
                $data['collection'] = $collect;
             }else{
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_ref_unit`.`unit`,
                `t_ref_unit`.`id` AS `id_unit`,
                `t_lap_awas`.`tahun`,
                `t_lap_awas`.`id`,
                `t_lap_awas`.`id_status_kirim`,
                `t_ref_jenis_awas`.`jenis_awas`,
                `t_lap_awas_temuan`.`id` AS `id_temuan`,
                `t_ref_kod_temuan1`.`id` AS `IdKlasTemuan`,
                `t_ref_kod_temuan1`.`Deskripsi` AS `KlasTemuan`,
                `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                `t_ref_kod_sebab1`.`id` AS `IdKlasSebab`,
                `t_ref_kod_sebab1`.`Deskripsi` AS `KlasSebab`,
                `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                `t_ref_kod_rekomendasi`.`id` AS `IdKlasRekomendasi`,
                `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                `t_ref_tl`.`deskripsi` AS `KodTL`,
                `t_ref_statkirim`.`status` AS `statusKirim`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('cms_users','t_lap_awas.id_user','=','cms_users.id')->
                leftjoin('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')->
                leftjoin('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')->
                leftjoin('t_ref_kod_sebab AS t_ref_kod_sebab1','t_ref_kod_sebab.Id_up_sebab','=','t_ref_kod_sebab1.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                orderby('unit','asc')->
                get();
                $data['indexWas'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                        `t_ref_unit`.`id` AS `id_unit`,
                        `t_ref_unit`.`unit` AS `unit`,
                        `t_ref_jenis_awas`.`jenis_awas` AS `jenis_awas`,
                        count(DISTINCT `t_lap_awas`.`id`) AS `jml_pengawasan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->orderby('unit','asc')
                ->groupBy('ID','t_ref_unit.id','t_ref_unit.unit','t_ref_jenis_awas.jenis_awas')
                ->get();
                $data['indexTemuan'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(DISTINCT `t_lap_awas_temuan`.`id`) AS `jml_temuan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->groupBy('ID')
                ->get();
                $data['indexRekomend'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(`t_lap_awas_rekomend`.`id`) AS `jml_rekomendasi`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->leftjoin('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                ->leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->groupBy('ID')
                ->get();


                foreach($data['indexWas'] as $was){
                    $was->jml_temuan = $data['indexTemuan']->where('ID',$was->ID)->first()->jml_temuan;
                    $was->jml_rekomendasi = $data['indexRekomend']->where('ID',$was->ID)->first()->jml_rekomendasi;
                    $collect[] = $was;
                }


                if($collect != null){
                    for($i=0; $i < count($collect); $i++){
                    $collect[0]->urutan = 1;
                    if($collect[$i]->id_unit === $collect[$i-1]->id_unit){
                        $collect[$i]->urutan = $collect[$i-1]->urutan;
                    }else{
                        $collect[$i]->urutan = $collect[$i-1]->urutan + 1;
                    }

                }
                }

                $data['collection'] = $collect;
             }

             //dd($data['collection']);

            $this->cbView('lapTLanjut',$data);


        }


	}
