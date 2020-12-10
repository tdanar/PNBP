<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminDJAwasController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_giat_was";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = false;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t_lap_awas";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"User","name"=>"id_user","join"=>"user,id"];
			$this->col[] = ["label"=>"Status Kirim","name"=>"id_status_kirim","join"=>"status_kirim,id"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'User','name'=>'id_user','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'user,id'];
			$this->form[] = ['label'=>'Status Kirim','name'=>'id_status_kirim','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'status_kirim,id'];
			$this->form[] = ['label'=>'Tahun','name'=>'tahun','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'No Lap','name'=>'no_lap','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal','name'=>'tanggal','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Giat Was','name'=>'nama_giat_was','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Thn Mulai','name'=>'thn_mulai','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Thn Usai','name'=>'thn_usai','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Was','name'=>'id_jenis_was','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'jenis_was,id'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"User","name"=>"id_user","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"user,id"];
			//$this->form[] = ["label"=>"Status Kirim","name"=>"id_status_kirim","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"status_kirim,id"];
			//$this->form[] = ["label"=>"Tahun","name"=>"tahun","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"No Lap","name"=>"no_lap","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Nama Giat Was","name"=>"nama_giat_was","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Thn Mulai","name"=>"thn_mulai","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Thn Usai","name"=>"thn_usai","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Jenis Was","name"=>"id_jenis_was","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"jenis_was,id"];
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

        public function getIndex() {
            //First, Add an auth
             if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
             $data = [];
             $data['page_title'] = 'Laporan Pengawasan PNBP';
             $input = [];
             $input['tahun'] = $_GET['tahun'];
             $input['statusKirim'] = $_GET['statusKirim'];
             $filters = [
                't_lap_awas.tahun' => 'tahun',
                't_lap_awas.id_status_kirim' => 'statusKirim'
            ];
            $data['input'] = collect($input);

             if(in_array(CRUDBooster::myPrivilegeId(),array(2,5))){
                $data['unit'] = CRUDBooster::myUnit();
                //$data['idunit'] = CRUDBooster::myUnitId();
                $queryku = '&'.implode('&', array_map(
                    function ($v, $k) { return sprintf("%s=%s", $k, $v); },
                    $input,
                    array_keys($input)
                ));
                
                //dd($queryku);
                $data['tahunSelector'] = DB::table('t_lap_awas')->join('cms_users','cms_users.id','=','t_lap_awas.id_user')->where('cms_users.id_kode_unit',CRUDBooster::myUnitId())->get();
                $data['statusSelector'] = DB::table('t_lap_awas')->leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->leftjoin('t_ref_statkirim','t_ref_statkirim.id','=','t_lap_awas.id_status_kirim')->where('cms_users.id_kode_unit',CRUDBooster::myUnitId())->get();
                $data['resultInputer'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas.id) AS `Jumlah`,cms_users.name AS `Nama`,CONCAT("/ma/lap_awas?user=",cms_users.name,"'.$queryku.'") AS `url`')
                                            ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                            ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                            ->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                                            ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                            ->where(
                                                    function ($query) use ($input, $filters) {
                                                        foreach ($filters as $column => $key) {
                                                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                                $query->where($column, $value);
                                                            });
                                                        }
                                                    }
                                                )
                                            ->groupBy('cms_users.name')
                                            ->get());
                                                    //dd($data['resultInputer']);
                $data['result1'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas.id) AS `Jumlah`,t_ref_jenis_awas.jenis_awas AS `Jenis Pengawasan`')
                                       ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                       ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                       ->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_jenis_awas.jenis_awas')
                                       ->get());

                $data['result2'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_temuan1.Deskripsi AS `Jenis Temuan`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                                       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                                       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_temuan1.Deskripsi')
                                       ->get());
                $data['result3'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_sebab1.Deskripsi AS `Jenis Sebab`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                       ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                                       ->join('t_ref_kod_sebab AS t_ref_kod_sebab1','t_ref_kod_sebab.Id_up_sebab','=','t_ref_kod_sebab1.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_sebab1.Deskripsi')
                                       ->get());
                $data['result4'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_kod_rekomendasi.Deskripsi AS `Jenis Rekomendasi`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_rekomendasi.Deskripsi')
                                       ->get());
                $data['result5'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_tl.deskripsi AS `Jenis Tindak Lanjut`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->get());
                $data['batang1'] = json_encode(DB::table('t_ref_unit')->selectRaw('SUM(t_lap_awas_temuan.nilai_uang) AS `NilaiUang`,t_ref_kod_temuan1.Deskripsi AS `KodTemuan`,t_ref_matauang.kode')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                        ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                                       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_temuan1.Deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get());
               $data['batang2'] = json_encode(DB::table('t_ref_unit')->selectRaw('`t_ref_matauang`.`kode`, SUM(`t_lap_awas_temuan`.`nilai_uang`) AS `NilaiUang`, `t_ref_tl`.`deskripsi` AS `statusTL`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get());
                $data['matauang'] = DB::table('t_ref_unit')->selectRaw('DISTINCT `t_ref_matauang`.`kode`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where('t_ref_unit.id', CRUDBooster::myUnitId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get();
             }
             /* elseif(in_array(CRUDBooster::myPrivilegeId(),array(2))){
                $data['unit'] = CRUDBooster::myUnit();
                $data['user'] = CRUDBooster::myName();
                $data['tahunSelector'] = DB::table('t_lap_awas')->join('cms_users','cms_users.id','=','t_lap_awas.id_user')->where('cms_users.id',CRUDBooster::myId())->get();
                $data['statusSelector'] = DB::table('t_lap_awas')->leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->leftjoin('t_ref_statkirim','t_ref_statkirim.id','=','t_lap_awas.id_status_kirim')->where('cms_users.id',CRUDBooster::myId())->get();
                $data['result1'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas.id) AS `Jumlah`,t_ref_jenis_awas.jenis_awas AS `Jenis Pengawasan`')
                                       ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                       ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                       ->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_jenis_awas.jenis_awas')
                                       ->get());

                $data['result2'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_temuan1.Deskripsi AS `Jenis Temuan`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                                       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                                       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_temuan1.Deskripsi')
                                       ->get());
                $data['result3'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_sebab1.Deskripsi AS `Jenis Sebab`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                       ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                                       ->join('t_ref_kod_sebab AS t_ref_kod_sebab1','t_ref_kod_sebab.Id_up_sebab','=','t_ref_kod_sebab1.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_sebab1.Deskripsi')
                                       ->get());
                $data['result4'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_kod_rekomendasi.Deskripsi AS `Jenis Rekomendasi`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_rekomendasi.Deskripsi')
                                       ->get());
                $data['result5'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_tl.deskripsi AS `Jenis Tindak Lanjut`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->get());
                $data['batang1'] = json_encode(DB::table('t_ref_unit')->selectRaw('SUM(t_lap_awas_temuan.nilai_uang) AS `NilaiUang`,t_ref_kod_temuan1.Deskripsi AS `KodTemuan`,t_ref_matauang.kode')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                        ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                                       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_temuan1.Deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get());
               $data['batang2'] = json_encode(DB::table('t_ref_unit')->selectRaw('`t_ref_matauang`.`kode`, SUM(`t_lap_awas_temuan`.`nilai_uang`) AS `NilaiUang`, `t_ref_tl`.`deskripsi` AS `statusTL`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get());
                $data['matauang'] = DB::table('t_ref_unit')->selectRaw('DISTINCT `t_ref_matauang`.`kode`')
                                        ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                        ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                        ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where('cms_users.id', CRUDBooster::myId())
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get();
             } */
             else{

                $queryku = '&'.implode('&', array_map(
                    function ($v, $k) { return sprintf("%s=%s", $k, $v); },
                    $input,
                    array_keys($input)
                ));
                $data['tahunSelector'] = DB::table('t_lap_awas')->get();
                $data['statusSelector'] = DB::table('t_lap_awas')->leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->leftjoin('t_ref_statkirim','t_ref_statkirim.id','=','t_lap_awas.id_status_kirim')->where('cms_users.id_kode_unit',CRUDBooster::myUnitId())->get();
                $data['resultInputer'] = json_encode(DB::table('t_ref_unit')->selectRaw('COUNT(t_lap_awas.id) AS `Jumlah`,cms_users.name AS `Nama`,CONCAT("/ma/lap_awas?user=",cms_users.name,"'.$queryku.'") AS `url`')
                                            ->join('cms_users','t_ref_unit.id','=','cms_users.id_kode_unit')
                                            ->join('t_lap_awas','cms_users.id','=','t_lap_awas.id_user')
                                            ->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                                            ->where(
                                                    function ($query) use ($input, $filters) {
                                                        foreach ($filters as $column => $key) {
                                                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                                $query->where($column, $value);
                                                            });
                                                        }
                                                    }
                                                )
                                            ->groupBy('cms_users.name')
                                            ->get());
                $data['result1'] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas.id) AS `Jumlah`,t_ref_jenis_awas.jenis_awas AS `Jenis Pengawasan`')
                                       ->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_jenis_awas.jenis_awas')
                                       ->get());
               $data['result2'] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_temuan1.Deskripsi AS `Jenis Temuan`')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                                       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_temuan1.Deskripsi')
                                       ->get());
               $data['result3'] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_temuan.id) AS `Jumlah`,t_ref_kod_sebab1.Deskripsi AS `Jenis Sebab`')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                                       ->join('t_ref_kod_sebab AS t_ref_kod_sebab1','t_ref_kod_sebab.Id_up_sebab','=','t_ref_kod_sebab1.id')
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_sebab1.Deskripsi')
                                       ->get());
               $data['result4'] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_kod_rekomendasi.Deskripsi AS `Jenis Rekomendasi`')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_rekomendasi.Deskripsi')
                                       ->get());
               $data['result5'] = json_encode(DB::table('t_lap_awas')->selectRaw('COUNT(t_lap_awas_rekomend.id) AS `Jumlah`,t_ref_tl.deskripsi AS `Jenis Tindak Lanjut`')
                                       ->join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->get());
               $data['batang1'] = json_encode(DB::table('t_lap_awas_temuan')->selectRaw('SUM(t_lap_awas_temuan.nilai_uang) AS `NilaiUang`,t_ref_kod_temuan1.Deskripsi AS `KodTemuan`,t_ref_matauang.kode')
                                        ->join('t_lap_awas','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                                       ->join('t_ref_kod_temuan AS t_ref_kod_temuan1','t_ref_kod_temuan.id_up2','=','t_ref_kod_temuan1.id')
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_kod_temuan1.Deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get());
               $data['batang2'] = json_encode(DB::table('t_lap_awas_temuan')->selectRaw('`t_ref_matauang`.`kode`, SUM(`t_lap_awas_temuan`.`nilai_uang`) AS `NilaiUang`, `t_ref_tl`.`deskripsi` AS `statusTL`')
                                        ->join('t_lap_awas','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
                                       ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                       ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                       ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                       ->where(
                                                function ($query) use ($input, $filters) {
                                                    foreach ($filters as $column => $key) {
                                                        $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                                            $query->where($column, $value);
                                                        });
                                                    }
                                                }
                                            )
                                       ->groupBy('t_ref_tl.deskripsi')
                                       ->groupBy('t_ref_matauang.kode')
                                       ->get());
                $data['matauang'] = DB::table('t_lap_awas_temuan')->selectRaw('DISTINCT `t_ref_matauang`.`kode`')
                                    ->join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')
                                    ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                                    ->join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')
                                    ->groupBy('t_ref_tl.deskripsi')
                                    ->groupBy('t_ref_matauang.kode')
                                    ->get();
             }

            //dd($data['batang2']);

             //Create a view. Please use `cbView` method instead of view method from laravel.
             $this->cbView('diagAwas',$data);
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



	    //By the way, you can still create your own method in here... :)


	}
