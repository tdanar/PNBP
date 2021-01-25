<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
    use CRUDBooster;
    use Illuminate\Support\Facades\Storage;

	class AdminArticleController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "judul";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
            $this->button_export = false;
			$this->label_add_button = "Tambah Artikel";
			$this->return_url2 = '/ma/manajemenGrafik';
			$this->table = "t_article";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Pembuat","name"=>"id_penulis","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"Judul","name"=>"judul"];
            $this->col[] = ["label"=>"Cover","name"=>"cover","image"=>true];
			$this->col[] = ["label"=>"Sumber","name"=>"link","callback"=>function($row){
                if($row->link){
                    return '<center><a href="'.$row->link.'" class="btn btn-primary">Cek</a></center>';
                }else{
                    return '<span class="text-danger">No Link</span>';
                }

            }];
			$this->col[] = ["label"=>"Dibuat Pada","name"=>"created_at"];
			$this->col[] = ["label"=>"Diubah Pada","name"=>"updated_at"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Penulis','name'=>'id_penulis','type'=>'hidden','validation'=>'required|integer|min:0','width'=>'col-sm-10', 'value' => CRUDBooster::myId()];
			$this->form[] = ['label'=>'Judul','name'=>'judul','type'=>'text','validation'=>'required|min:3|max:125','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Sub Judul','name'=>'sub_judul','type'=>'text','validation'=>'min:3|max:255','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Gambar Sampul','name'=>'cover','type'=>'upload','validation'=>'required|image|max:1000','upload_encrypt'=>true, 'user_id'=>'article_cover'];
            $this->form[] = ['label'=>'Sumber','name'=>'link','type'=>'text','validation'=>'url|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Isi','name'=>'isi','type'=>'wysiwyg','validation'=>'required|min:5','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Penulis","name"=>"id_penulis","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"penulis,id"];
			//$this->form[] = ["label"=>"Judul","name"=>"judul","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"Anda hanya dapat memasukkan huruf saja"];
			//$this->form[] = ["label"=>"Sub Judul","name"=>"sub_judul","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Isi","name"=>"isi","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
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

        public function showArticle($id){
            $data = [];
            $data['row'] = DB::table('t_article')->where('id',$id)->first();
            $this->cbView('artikel',$data);
        }

        public function delImage($id,$column){


            $this->cbLoader();
            $id = $id;
            $column = $column;

            $row = DB::table($this->table)->where($this->primary_key, $id)->first();

            if (! CRUDBooster::isDelete() && $this->global_privilege == false) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete_image", [
                    'name' => $row->{$this->title_field},
                    'module' => CRUDBooster::getCurrentModule()->name,
                ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
            }

            $row = DB::table($this->table)->where($this->primary_key, $id)->first();

            $file = '/'.$row->{$column};

            if (Storage::exists($file)) {
                Storage::delete($file);
            }


            CRUDBooster::insertLog(trans("crudbooster.log_delete_image", [
                'name' => $row->{$this->title_field},
                'module' => CRUDBooster::getCurrentModule()->name,
            ]));


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
            $postdata['judul'] = strip_tags($_POST['judul']);
            $postdata['sub_judul'] = strip_tags($_POST['sub_judul']);
            //$postdata['isi'] = strip_tags($_POST['isi']);
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
            $postdata['judul'] = strip_tags($_POST['judul']);
            $postdata['sub_judul'] = strip_tags($_POST['sub_judul']);
            //$postdata['isi'] = strip_tags($_POST['isi']);
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
            $this->delImage($id,'cover');
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
