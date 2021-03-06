<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminLapAwasRekomendController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "rekomendasi";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
            $this->button_add = true;
            $this->label_add_button = "Tambah Rekomendasi";
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
            $this->table = "t_lap_awas_rekomend";
            $this->show_numbering = TRUE;
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			//$this->col[] = ["label"=>"Temuan","name"=>"id_temuan","join"=>"t_lap_awas_temuan,judul"];
			$this->col[] = ["label"=>"Rekomendasi","name"=>"rekomendasi"];
			$this->col[] = ["label"=>"Klasifikasi Rekomendasi","name"=>"id_kod_rekomendasi","join"=>"t_ref_kod_rekomendasi,Deskripsi"];
			$this->col[] = ["label"=>"Tanggal TL","name"=>"tgl_tl",'callback_php'=>'date("d-m-Y",strtotime($row->tgl_tl))'];
			$this->col[] = ["label"=>"Uraian TL","name"=>"tl"];
			// $this->col[] = ["label"=>"Status TL","name"=>"status_tl"];
			$this->col[] = ["label"=>"Status TL","name"=>"id_kod_tl","join"=>"t_ref_tl,deskripsi"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Temuan','name'=>'id_temuan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_lap_awas_temuan,judul'];
			$this->form[] = ['label'=>'Rekomendasi','name'=>'rekomendasi','type'=>'textarea','validation'=>'required|min:1','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Kodefikasi Rekomendasi','name'=>'id_kod_rekomendasi','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'t_ref_kod_rekomendasi,Deskripsi'];
			$this->form[] = ['label'=>'Tgl. Tindak Lanjut','name'=>'tgl_tl','type'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Uraian Tindak Lanjut','name'=>'tl','type'=>'textarea','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Status Tindak Lanjut','name'=>'status_tl','type'=>'select','width'=>'col-sm-10','dataenum'=>'Dalam Proses;Tuntas'];
			$this->form[] = ['label'=>'Status Tindak Lanjut','name'=>'id_kod_tl','type'=>'select','width'=>'col-sm-10','datatable'=>'t_ref_tl,deskripsi'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Temuan','name'=>'id_temuan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_lap_awas_temuan,judul'];
			//$this->form[] = ['label'=>'Rekomendasi','name'=>'rekomendasi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Kodifikasi Rekomendasi','name'=>'id_kod_rekomendasi','type'=>'select2','width'=>'col-sm-10','datatable'=>'t_ref_kod_rekomendasi,Deskripsi'];
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
            //$this->sub_module[] = ['label'=>'Tindak Lanjut','path'=>'lap_awas_tlanjut','foreign_key'=>'id_rekomendasi','button_color'=>'primary','button_icon'=>'fa fa-bars','parent_columns'=>'rekomendasi'];


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

        public function getEdit($id){
            $this->button_addmore = FALSE;
            $this->button_cancel  = TRUE;
            $this->button_show    = FALSE;
            $this->button_add     = FALSE;
            $this->button_delete  = FALSE;
            $this->hide_form 	  = ['id_temuan'];


            $data['page_title'] = 'Edit Rekomendasi';
            $data['row']        = CRUDBooster::first('t_lap_awas_rekomend',$id);
            $data['command']        = 'edit';

            //dd($data['row']);


            $this->cbView('crudbooster::default.form',$data);
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
            //unset($postdata['Id_up']);
            $postdata['rekomendasi'] = strip_tags($_POST['rekomendasi']);
            $postdata['tl'] = strip_tags($_POST['tl']);
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
            //unset($postdata['Id_up']);
            $postdata['rekomendasi'] = strip_tags($_POST['rekomendasi']);
            $postdata['tl'] = strip_tags($_POST['tl']);
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
