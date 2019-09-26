<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminLapAwasController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_giat_was";
			$this->limit = "10";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
            $this->button_action_style = "button_icon";
			$this->button_action_width = "3%";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = false;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
            $this->table = "t_lap_awas";
            $this->show_numbering = true;

			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
            $this->col = [];
            $this->col[] = ["label"=>"Id","name"=>"id","visible"=>false];
			$this->col[] = ["label"=>"Nomor Laporan","name"=>"no_lap"];
			$this->col[] = ["label"=>"Tanggal","name"=>"tanggal",'callback_php'=>'date("d-m-Y",strtotime($row->tanggal))'];
			$this->col[] = ["label"=>"Nama Kegiatan Pengawasan","name"=>"nama_giat_was"];
			//$this->col[] = ["label"=>"Temuan","name"=>"(select group_concat(t_lap_awas_temuan.judul separator '<br/>') from t_lap_awas_temuan join t_lap_awas on t_lap_awas_temuan.id_lap = t_lap_awas.id) as temuan"];
			//$this->col[] = ["label"=>"Mata Uang","name"=>"(select group_concat(t_ref_matauang.kode separator '<br/>') from t_ref_matauang join t_lap_awas_temuan on t_lap_awas_temuan.id_mata_uang = t_ref_matauang.id join t_lap_awas on t_lap_awas.id = t_lap_awas_temuan.id_lap) as matauang"];
			//$this->col[] = ["label"=>"Nilai","name"=>"id","join"=>"t_lap_awas_temuan,nilai_uang"];
			//$this->col[] = ["label"=>"Rekomendasi","name"=>"id","join"=>"t_lap_awas_temuan,id","join"=>"t_lap_awas_rekomend,rekomendasi"];
            //$this->col[] = ["label"=>"Status TL","name"=>"id","join"=>"t_lap_awas_temuan,id","join"=>"t_lap_awas_rekomend,id","join"=>"t_lap_awas_tlanjut,status"];
			//$this->col[] = ["label"=>"Inputer","name"=>"id_user","join"=>"cms_users,name"];

			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Tahun','name'=>'tahun','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','dataenum'=>'2017;2018;2019'];
			$this->form[] = ['label'=>'No. Laporan','name'=>'no_lap','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal','name'=>'tanggal','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Keg. Pengawasan','name'=>'nama_giat_was','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tahun Mulai','name'=>'thn_mulai','type'=>'select','validation'=>'required','width'=>'col-sm-10','dataenum'=>'2017;2018;2019'];
			$this->form[] = ['label'=>'Tahun Usai','name'=>'thn_usai','type'=>'select','validation'=>'required','width'=>'col-sm-10','dataenum'=>'2017;2018;2019'];
            $this->form[] = ['label'=>'Jenis Pengawasan','name'=>'id_jenis_was','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_ref_jenis_awas,jenis_awas'];
            $this->form[] = ['label'=>'Id User','name'=>'id_user','type'=>'hidden','value' => CRUDBooster::myId()];
			$this->form[] = ['label'=>'Status Kirim','name'=>'id_status_kirim','type'=>'hidden','value' => 1];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Tahun','name'=>'tahun','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','dataenum'=>'2017;2018;2019'];
			//$this->form[] = ['label'=>'Nomor Laporan','name'=>'no_lap','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tanggal','name'=>'tanggal','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Nama Kegiatan Was','name'=>'nama_giat_was','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Thn Mulai','name'=>'thn_mulai','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Thn Usai','name'=>'thn_usai','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Jenis Pengawasan','name'=>'id_jenis_was','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_ref_jenis_awas,jenis_awas'];
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
	        //$this->sub_module = array();

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
            //$this->addaction = array();
            $this->addaction[] = ['label'=>'Export Word','url'=>'/files/PNBPeksport.docx', 'icon'=>'fa fa-file-word-o'];
            $this->addaction[] = ['label'=>'Export Excel','url'=>'/files/PNBPeksport.xlsx', 'icon'=>'fa fa-file-excel-o'];

            $this->sub_module[] = ['label'=>'Temuan','path'=>'lap_awas_temuan','foreign_key'=>'id_lap','button_color'=>'danger','button_icon'=>'fa fa-bars','parent_columns'=>'nama_giat_was,no_lap'];


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
	        //$this->load_js = array();
            $this->load_js[] = asset("js/detailRow.js");


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


        /* public function getIndex() {
            //First, Add an auth
             if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

             //Create your own query
             $data = [];
             $data['page_title'] = 'Laporan Pengawasan PNBP';
             $data['result'] = DB::table('t_lap_awas')->orderby('id','desc')->paginate(10);

             //Create a view. Please use `cbView` method instead of view method from laravel.
             $this->cbView('lapAwas',$data);
          }
 */
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
            if(!CRUDBooster::isSuperadmin()){
                $query->where('id_user',CRUDBooster::myId());
            }

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
