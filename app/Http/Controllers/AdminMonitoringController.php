<?php namespace App\Http\Controllers;

use Session;
use DB;
use CRUDBooster;
use Excel;
use Request;
use Response;
use DataTables;
use Illuminate\Http\Request as Rikues;

	class AdminMonitoringController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t_lap_awas";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Unit K/L","name"=>"id_user","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"No. Laporan","name"=>"no_lap"];
			$this->col[] = ["label"=>"Tanggal Laporan","name"=>"tanggal"];
			$this->col[] = ["label"=>"Nama Keg. Pengawasan","name"=>"nama_giat_was"];
			$this->col[] = ["label"=>"Periode Pengawasan","name"=>"tahun"];
			$this->col[] = ["label"=>"Jenis Pengawasan","name"=>"id_jenis_was","join"=>"t_ref_jenis_awas,jenis_awas"];
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
            $this->index_button[] = ['label'=>'Export ke Excel','url'=>'#','icon'=>'fa fa-download','indexonly' => 'false'];


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

        public function getTemuan($id){
            $data = DB::table('t_ref_kod_temuan')->select('Deskripsi')->first('id',$id);
            return $data->Deskripsi;
        }

        public function getSebab($id){
            $data = DB::table('t_ref_kod_sebab')->select('Deskripsi')->first('id',$id);
            return $data->Deskripsi;
        }

        public function getRek($id){
            $data = DB::table('t_ref_kod_rekomendasi')->select('Deskripsi')->first('id',$id);
            return $data->Deskripsi;
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
                't_ref_kod_temuan.id_up2' => 'klasTemuan',
                't_ref_kod_sebab.Id_up_sebab' => 'klasSebab',
                't_ref_kod_rekomendasi.id' => 'klasRek',
                't_ref_tl.deskripsi' => 'KodTL'
            ];
            $data = [];
            $data['page_title'] = 'Monitoring Pengawasan PNBP';
            $data['input'] = collect($input);
            if(CRUDBooster::myPrivilegeId() == 4){
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_lap_awas`.`no_lap`,
                `t_lap_awas`.`tanggal`,
                `t_lap_awas`.`nama_giat_was`,
                `t_lap_awas`.`id`,
                `t_lap_awas`.`id_status_kirim`,
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
                `t_lap_awas_rekomend`.`rekomendasi`,
                `cms_users`.`email`,
                `cms_users`.`id_kode_unit`,
                `t_ref_unit`.`unit`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                leftjoin('cms_users','t_lap_awas.id_user','=','cms_users.id')->
                leftjoin('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')->
                where('id_status_kirim',2)->orderby('id','desc')->
                get();
                $data['klasTemuan'] = DB::table('t_ref_kod_temuan')
                                        ->where('Id_up','!=',null)
                                        ->where('id_up2',0)
                                        ->orderBy('Deskripsi','asc')
                                        ->get();
                $data['klasSebab'] = DB::table('t_ref_kod_sebab')
                                        ->where('Id_up_sebab',null)
                                        ->orderBy('Deskripsi','asc')
                                        ->get();
                 $data['klasRek'] = DB::table('t_ref_kod_rekomendasi')
                                        ->orderBy('Deskripsi','asc')
                                        ->get();
                $data['indexWas'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                        `t_ref_unit`.`unit` AS `unit`,
                        `t_ref_jenis_awas`.`jenis_awas` AS `jenis_awas`,
                        count(`t_lap_awas`.`id`) AS `jml_pengawasan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->where('t_lap_awas.id_status_kirim',2)
                ->groupBy('ID','t_ref_unit.unit','t_ref_jenis_awas.jenis_awas')
                ->get();
                $data['indexTemuan'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(`t_lap_awas_temuan`.`id`) AS `jml_temuan`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->join('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')
                ->join('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')
                ->where('t_lap_awas.id_status_kirim',2)
                ->groupBy('ID')
                ->get();
                $data['indexRekomend'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    count(`t_lap_awas_temuan`.`id`) AS `jml_rekomendasi`'
                )->join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')
                ->join('t_lap_awas_temuan','t_lap_awas.id','=','t_lap_awas_temuan.id_lap')
                ->join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
                ->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->join('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')
                ->where('t_lap_awas.id_status_kirim',2)
                ->groupBy('ID')
                ->get();


                foreach($data['indexWas'] as $was){
                    $was->jml_temuan = $data['indexTemuan']->where('ID',$was->ID)->first()->jml_temuan;
                    $was->jml_rekomendasi = $data['indexRekomend']->where('ID',$was->ID)->first()->jml_rekomendasi;
                    $collect[] = $was;
                }

                //dd($data['klasTemuan']);
                $data['collection'] = $collect;
             }else{
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_ref_unit`.`unit`,
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
                `t_ref_tl`.`deskripsi` AS `KodTL`')->
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
                orderby('id','desc')->
                get();
                $data['indexWas'] = DB::table('t_lap_awas')->selectRaw(
                    'concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
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
                ->where(
                    function ($query) use ($input, $filters) {
                        foreach ($filters as $column => $key) {
                            $query->when(array_get($input, $key), function ($query, $value) use ($column) {
                                $query->where($column, $value);
                            });
                        }
                    }
                )
                ->groupBy('ID','t_ref_unit.unit','t_ref_jenis_awas.jenis_awas')
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
                $data['collection'] = $collect;
             }

             //dd($data['input']);

            $this->cbView('lapMonitoring',$data);


        }

        public function getDlPDF($id){
            $id_unit = substr($id,0,-1);
            $id_jenis_was = substr($id,-1);
            if(CRUDBooster::myPrivilegeId() == 4){
                $data['data'] = DB::table('t_lap_awas')
                ->selectRaw('t_lap_awas.*, t_ref_unit.unit')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->where('t_lap_awas.id_jenis_was',$id_jenis_was)
                ->where('t_ref_unit.id',$id_unit)
                ->where('id_status_kirim',2)
                ->get();

            }else{
                $data['data'] = DB::table('t_lap_awas')
                ->selectRaw('t_lap_awas.*, t_ref_unit.unit')
                ->join('cms_users','t_lap_awas.id_user','=','cms_users.id')->join('t_ref_unit','cms_users.id_kode_unit','=','t_ref_unit.id')
                ->where('t_lap_awas.id_jenis_was',$id_jenis_was)
                ->where('t_ref_unit.id',$id_unit)
                ->get();
            }

            //dd($id_unit,$id_jenis_was);
            return view('modal.downPDF',$data);
        }

        public function getMonitorWas() {

            if(Session::has('admin_id')){
                if(CRUDBooster::myPrivilegeId() == 4){
                    $data = DB::table('t_lap_awas')->selectRaw('t_ref_unit.unit, t_ref_jenis_awas.jenis_awas ,count(t_lap_awas.id) as jml_pengawasan')->
                    join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                    where('id_status_kirim',2)->
                    groupby('t_ref_jenis_awas.jenis_awas')->
                    get();
                 }else{

                    $data = collect(DB::select(DB::raw('
                    SELECT
                    `cms_users`.`id_kode_unit`,
                    `t_ref_unit`.`unit`,
                    `t_lap_awas`.`tahun`,
                    `t_lap_awas`.`id`,
                    `t_lap_awas`.`id_status_kirim`,
                    `t_ref_jenis_awas`.`jenis_awas`,
                    `t_lap_awas_temuan`.`id` AS `id_temuan`,
                    `t_ref_kod_temuan`.`Kode` AS `KodeTemuan`,
                    `t_ref_kod_temuan`.`Deskripsi` AS `DeskTemuan`,
                    `t_ref_kod_sebab`.`Kode` AS `KodeSebab`,
                    `t_ref_kod_sebab`.`Deskripsi` AS `DeskSebab`,
                    `t_lap_awas_rekomend`.`id` AS `id_rekomendasi`,
                    `t_ref_kod_rekomendasi`.`Kode` AS `KodeRekomendasi`,
                    `t_ref_kod_rekomendasi`.`Deskripsi` AS `DeskRekomendasi`,
                    `t_ref_tl`.`deskripsi` AS `KodTL`
                  FROM
                    `t_lap_awas_temuan`
                    RIGHT OUTER JOIN `t_lap_awas` ON (`t_lap_awas_temuan`.`id_lap` = `t_lap_awas`.`id`)
                    INNER JOIN `t_ref_jenis_awas` ON (`t_lap_awas`.`id_jenis_was` = `t_ref_jenis_awas`.`id`)
                    LEFT OUTER JOIN `t_ref_kod_temuan` ON (`t_lap_awas_temuan`.`id_kod_temuan` = `t_ref_kod_temuan`.`id`)
                    LEFT OUTER JOIN `t_ref_kod_sebab` ON (`t_lap_awas_temuan`.`id_kod_sebab` = `t_ref_kod_sebab`.`id`)
                    LEFT OUTER JOIN `t_lap_awas_rekomend` ON (`t_lap_awas_temuan`.`id` = `t_lap_awas_rekomend`.`id_temuan`)
                    LEFT OUTER JOIN `t_ref_kod_rekomendasi` ON (`t_lap_awas_rekomend`.`id_kod_rekomendasi` = `t_ref_kod_rekomendasi`.`id`)
                    LEFT OUTER JOIN `t_ref_tl` ON (`t_lap_awas_rekomend`.`id_kod_tl` = `t_ref_tl`.`id`)
                    LEFT OUTER JOIN `cms_users` ON (`t_lap_awas`.`id_user` = `cms_users`.`id`)
                    INNER JOIN `t_ref_unit` ON (`cms_users`.`id_kode_unit` = `t_ref_unit`.`id`)
                  ')));
                    /* $data = collect(DB::select(DB::raw('select
                    `vw_jml_pengawasan`.`unit` AS `unit`,
                    `vw_jml_pengawasan`.`jenis_awas` AS `jenis_awas`,
                    `vw_jml_pengawasan`.`jml_pengawasan` AS `jml_pengawasan`,
                    `vw_jml_temuan`.`jml_temuan` AS `jml_temuan`,
                    `vw_jml_rekomendasi`.`jml_rekomendasi` AS `jml_rekomendasi`
                  from (((select
                    concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    `t_ref_unit`.`unit` AS `unit`,
                    `t_ref_jenis_awas`.`jenis_awas` AS `jenis_awas`,
                    count(`t_lap_awas`.`id`) AS `jml_pengawasan`
                  from (((`t_lap_awas`
                    join `t_ref_jenis_awas` on
                      (`t_lap_awas`.`id_jenis_was` = `t_ref_jenis_awas`.`id`))
                    join `cms_users` on
                      (`t_lap_awas`.`id_user` = `cms_users`.`id`))
                    join `t_ref_unit` on
                      (`cms_users`.`id_kode_unit` = `t_ref_unit`.`id`))
                  group by
                    concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`),
                    `t_ref_unit`.`unit`,
                    `t_ref_jenis_awas`.`jenis_awas`) AS `vw_jml_pengawasan`
                    left join (select
                    concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    `t_ref_unit`.`unit` AS `unit`,
                    `t_ref_jenis_awas`.`jenis_awas` AS `jenis_awas`,
                    count(`t_lap_awas_temuan`.`id`) AS `jml_temuan`
                  from ((((`t_lap_awas`
                    join `t_ref_jenis_awas` on
                      (`t_lap_awas`.`id_jenis_was` = `t_ref_jenis_awas`.`id`))
                    join `cms_users` on
                      (`cms_users`.`id` = `t_lap_awas`.`id_user`))
                    join `t_lap_awas_temuan` on
                      (`t_lap_awas`.`id` = `t_lap_awas_temuan`.`id_lap`))
                    join `t_ref_unit` on
                      (`t_ref_unit`.`id` = `cms_users`.`id_kode_unit`))
                  group by
                    concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`),
                    `t_ref_unit`.`unit`,
                    `t_ref_jenis_awas`.`jenis_awas`) AS `vw_jml_temuan` on
                      (`vw_jml_pengawasan`.`ID` = `vw_jml_temuan`.`ID`))
                    left join (select
                    concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`) AS `ID`,
                    `t_ref_unit`.`unit` AS `unit`,
                    `t_ref_jenis_awas`.`jenis_awas` AS `jenis_awas`,
                    count(`t_lap_awas_rekomend`.`id`) AS `jml_rekomendasi`
                  from (((((`t_lap_awas`
                    join `t_ref_jenis_awas` on
                      (`t_lap_awas`.`id_jenis_was` = `t_ref_jenis_awas`.`id`))
                    join `cms_users` on
                      (`cms_users`.`id` = `t_lap_awas`.`id_user`))
                    join `t_lap_awas_temuan` on
                      (`t_lap_awas`.`id` = `t_lap_awas_temuan`.`id_lap`))
                    join `t_ref_unit` on
                      (`t_ref_unit`.`id` = `cms_users`.`id_kode_unit`))
                    join `t_lap_awas_rekomend` on
                      (`t_lap_awas_temuan`.`id` = `t_lap_awas_rekomend`.`id_temuan`))
                  group by
                    concat(`t_ref_unit`.`id`,`t_lap_awas`.`id_jenis_was`),
                    `t_ref_unit`.`unit`,
                    `t_ref_jenis_awas`.`jenis_awas`) AS `vw_jml_rekomendasi` on
                      (`vw_jml_temuan`.`ID` = `vw_jml_rekomendasi`.`ID`))
                  '))); */
                 }

                 //dd($data);
                 return Datatables::of($data)->make(true);
            }else{
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }
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
