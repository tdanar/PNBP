<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
    use CRUDBooster;
    use Schema;
    use crocodicstudio\crudbooster\controllers\LogsController;

	class AdminLapAwasTemuanController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "judul";
			$this->limit = "20";
			$this->orderby = "id,asc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
            $this->button_add = true;
            $this->label_add_button = "Tambah Temuan";
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
            $this->button_export = false;
            $this->button_addmore = true;
            $this->button_addtemuan = false;
            $this->button_addtemuan_label = "Simpan dan Tambah Rekomendasi";
            $this->table = "t_lap_awas_temuan";
            $this->show_numbering = TRUE;
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			//$this->col[] = ["label"=>"Lap","name"=>"id_lap","join"=>"t_lap_awas,no_lap"];
			$this->col[] = ["label"=>"Judul","name"=>"judul"];
			$this->col[] = ["label"=>"Klasifikasi Temuan","name"=>"id_kod_temuan","join"=>"t_ref_kod_temuan,Deskripsi"];
			$this->col[] = ["label"=>"Kondisi","name"=>"kondisi"];
			$this->col[] = ["label"=>"Mata Uang","name"=>"id_mata_uang","join"=>"t_ref_matauang,kode"];
			$this->col[] = ["label"=>"Nilai Uang","name"=>"nilai_uang","callback"=>function($row) {
                return number_format($row->nilai_uang,0,",",".");
                }];
			$this->col[] = ["label"=>"Lokasi","name"=>"lokasi"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Lap','name'=>'id_lap','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_lap_awas,no_lap'];
            $this->form[] = ['label'=>'Judul','name'=>'judul','type'=>'text','validation'=>'required|min:1','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Kodifikasi Temuan','name'=>'id_kod_temuan','type'=>'datamodal','width'=>'col-sm-10','datamodal_table'=>'t_ref_kod_temuan','datamodal_where'=>'id_up2 != 0','datamodal_columns'=>'Deskripsi'];
			$this->form[] = ['label'=>'Kodifikasi Temuan','name'=>'id_up','type'=>'select','width'=>'col-sm-10','datatable'=>'t_ref_kod_temuan,Deskripsi','datatable_where'=>'id_up is null'];
            $this->form[] = ['label'=>'','name'=>'id_up2','type'=>'select','width'=>'col-sm-10','datatable'=>'t_ref_kod_temuan,Deskripsi','datatable_where'=>'id_up2 = 0','parent_select'=>'id_up'];
			$this->form[] = ['label'=>'','name'=>'id_kod_temuan','type'=>'select','validation'=>'required','width'=>'col-sm-10','datatable'=>'t_ref_kod_temuan,Deskripsi','datatable_where'=>'id_up is not null and id_up2 != 0','parent_select'=>'id_up2'];
            $this->form[] = ['label'=>'Kondisi','name'=>'kondisi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Mata Uang','name'=>'id_mata_uang','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_ref_matauang,kode'];
			$this->form[] = ['label'=>'Nilai Uang','name'=>'nilai_uang','type'=>'money','validation'=>'required','width'=>'col-sm-10','decimals'=>'0'];
			$this->form[] = ['label'=>'Lokasi','name'=>'lokasi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Kodifikasi Sebab','name'=>'Id_up_sebab','type'=>'select','width'=>'col-sm-10','datatable'=>'t_ref_kod_sebab,Deskripsi','datatable_where'=>'Id_up_sebab is null'];
            $this->form[] = ['label'=>'','name'=>'id_kod_sebab','type'=>'select','validation'=>'required','width'=>'col-sm-10','datatable'=>'t_ref_kod_sebab,Deskripsi','parent_select'=>'Id_up_sebab'];
			$this->form[] = ['label'=>'Sebab','name'=>'sebab','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Akibat','name'=>'akibat','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Lap','name'=>'id_lap','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_lap_awas,no_lap'];
			//$this->form[] = ['label'=>'Judul','name'=>'judul','type'=>'text','validation'=>'required|min:1','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Kodifikasi Temuan','name'=>'id_up','type'=>'select','width'=>'col-sm-10','datatable'=>'t_ref_kod_temuan,Deskripsi','datatable_where'=>'id_up is null'];
			//$this->form[] = ['label'=>'Kondisi','name'=>'kondisi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Mata Uang','name'=>'id_mata_uang','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_ref_matauang,kode'];
			//$this->form[] = ['label'=>'Nilai Uang','name'=>'nilai_uang','type'=>'money','validation'=>'required','width'=>'col-sm-10','decimals'=>'0'];
			//$this->form[] = ['label'=>'Lokasi','name'=>'lokasi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Kodifikasi Sebab','name'=>'id_up_sebab','type'=>'select','width'=>'col-sm-10','datatable'=>'t_ref_kod_sebab,Deskripsi','datatable_where'=>'Id_up_sebab is null'];
			//$this->form[] = ['label'=>'Sebab','name'=>'sebab','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Akibat','name'=>'akibat','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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
            $this->sub_module[] = ['label'=>'Rekomendasi','path'=>'lap_awas_rekomend','foreign_key'=>'id_temuan','button_color'=>'success','button_icon'=>'fa fa-bars','parent_columns'=>'judul'];


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
            $this->hide_form 	  = ['id_lap'];
            $this->button_edittemuan_label = "Edit Rekomendasi";


            $data['page_title'] = 'Edit Temuan';
            $data['row']        = CRUDBooster::first('t_lap_awas_temuan',$id);
            $data['command']        = 'edit';
            $id_up = CRUDBooster::first('t_ref_kod_temuan',$data['row']->id_kod_temuan)->Id_up;
            $id_up2 = CRUDBooster::first('t_ref_kod_temuan',$data['row']->id_kod_temuan)->id_up2;
            $Id_up_sebab = CRUDBooster::first('t_ref_kod_sebab',$data['row']->id_kod_sebab)->Id_up_sebab;
            $data['row']->id_up = $id_up;
            $data['row']->id_up2 = $id_up2;
            $data['row']->Id_up_sebab = $Id_up_sebab;

            //dd($data['row']);


            $this->cbView('crudbooster::default.form',$data);
        }

        public function postAddTemuan()
    {
        $this->cbLoader();
        //dd($this->sub_module[0]['path']);
        if (! CRUDBooster::isCreate() && $this->global_privilege == false) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add_save', [
                'name' => Request::input($this->title_field),
                'module' => CRUDBooster::getCurrentModule()->name,
            ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $this->validation();
        $this->input_assignment();

        if (Schema::hasColumn($this->table, 'created_at')) {
            $this->arr['created_at'] = date('Y-m-d H:i:s');
        }

        $this->hook_before_add($this->arr);

//         $this->arr[$this->primary_key] = $id = CRUDBooster::newId($this->table); //error on sql server
        $lastInsertId = $id = DB::table($this->table)->insertGetId($this->arr);

        $up_id = DB::table($this->table)->select('id_lap')->where('id',$lastInsertId)->first();

        //Looping Data Input Again After Insert
        foreach ($this->data_inputan as $ro) {
            $name = $ro['name'];
            if (! $name) {
                continue;
            }

            $inputdata = Request::get($name);

            //Insert Data Checkbox if Type Datatable
            if ($ro['type'] == 'checkbox') {
                if ($ro['relationship_table']) {
                    $datatable = explode(",", $ro['datatable'])[0];
                    $foreignKey2 = CRUDBooster::getForeignKey($datatable, $ro['relationship_table']);
                    $foreignKey = CRUDBooster::getForeignKey($this->table, $ro['relationship_table']);
                    DB::table($ro['relationship_table'])->where($foreignKey, $id)->delete();

                    if ($inputdata) {
                        $relationship_table_pk = CB::pk($ro['relationship_table']);
                        foreach ($inputdata as $input_id) {
                            DB::table($ro['relationship_table'])->insert([
//                                 $relationship_table_pk => CRUDBooster::newId($ro['relationship_table']),
                                $foreignKey => $id,
                                $foreignKey2 => $input_id,
                            ]);
                        }
                    }
                }
            }

            if ($ro['type'] == 'select2') {
                if ($ro['relationship_table']) {
                    $datatable = explode(",", $ro['datatable'])[0];
                    $foreignKey2 = CRUDBooster::getForeignKey($datatable, $ro['relationship_table']);
                    $foreignKey = CRUDBooster::getForeignKey($this->table, $ro['relationship_table']);
                    DB::table($ro['relationship_table'])->where($foreignKey, $id)->delete();

                    if ($inputdata) {
                        foreach ($inputdata as $input_id) {
                            $relationship_table_pk = CB::pk($row['relationship_table']);
                            DB::table($ro['relationship_table'])->insert([
//                                 $relationship_table_pk => CRUDBooster::newId($ro['relationship_table']),
                                $foreignKey => $id,
                                $foreignKey2 => $input_id,
                            ]);
                        }
                    }
                }
            }

            if ($ro['type'] == 'child') {
                $name = str_slug($ro['label'], '');
                $columns = $ro['columns'];
                $getColName = Request::get($name.'-'.$columns[0]['name']);
                $count_input_data = ($getColName)?(count($getColName) - 1):0;
                $child_array = [];

                for ($i = 0; $i <= $count_input_data; $i++) {
                    $fk = $ro['foreign_key'];
                    $column_data = [];
                    $column_data[$fk] = $id;
                    foreach ($columns as $col) {
                        $colname = $col['name'];
                        $column_data[$colname] = Request::get($name.'-'.$colname)[$i];
                    }
                    $child_array[] = $column_data;
                }

                $childtable = CRUDBooster::parseSqlTable($ro['table'])['table'];
                DB::table($childtable)->insert($child_array);
            }
        }

        $this->hook_after_add($lastInsertId);

        $this->return_url = CRUDBooster::adminPath($slug='lap_awas_rekomend').'?return_url='.urlencode(CRUDBooster::adminPath($slug='lap_awas_temuan').'foreign_key=id_lap&label=Temuan&parent_columns=nama_giat_was%2Cno_lap&parent_columns_alias=Nama%20Kegiatan%2CNo.%20Lap&parent_id='.$up_id.'&parent_table=t_lap_awas&return_url='.urlencode(CRUDBooster::adminPath($slug='lap_awas'))).'&parent_table=t_lap_awas_temuan&parent_columns=judul&parent_columns_alias=Judul Temuan&parent_id='.$lastInsertId.'&foreign_key=id_temuan&label=Rekomendasi';

        //insert log
        CRUDBooster::insertLog(trans("crudbooster.log_add", ['name' => $this->arr[$this->title_field], 'module' => CRUDBooster::getCurrentModule()->name]));

        return redirect($this->return_url);

    }
    public function postEditTemuan($id)
    {
        $this->cbLoader();
        $row = DB::table($this->table)->where($this->primary_key, $id)->first();

        if (! CRUDBooster::isUpdate() && $this->global_privilege == false) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_add", ['name' => $row->{$this->title_field}, 'module' => CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

        $this->validation($id);
        $this->input_assignment($id);

        if (Schema::hasColumn($this->table, 'updated_at')) {
            $this->arr['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->hook_before_edit($this->arr, $id);
        DB::table($this->table)->where($this->primary_key, $id)->update($this->arr);

        //Looping Data Input Again After Insert
        foreach ($this->data_inputan as $ro) {
            $name = $ro['name'];
            if (! $name) {
                continue;
            }

            $inputdata = Request::get($name);

            //Insert Data Checkbox if Type Datatable
            if ($ro['type'] == 'checkbox') {
                if ($ro['relationship_table']) {
                    $datatable = explode(",", $ro['datatable'])[0];

                    $foreignKey2 = CRUDBooster::getForeignKey($datatable, $ro['relationship_table']);
                    $foreignKey = CRUDBooster::getForeignKey($this->table, $ro['relationship_table']);
                    DB::table($ro['relationship_table'])->where($foreignKey, $id)->delete();

                    if ($inputdata) {
                        foreach ($inputdata as $input_id) {
                            $relationship_table_pk = CB::pk($ro['relationship_table']);
                            DB::table($ro['relationship_table'])->insert([
//                                 $relationship_table_pk => CRUDBooster::newId($ro['relationship_table']),
                                $foreignKey => $id,
                                $foreignKey2 => $input_id,
                            ]);
                        }
                    }
                }
            }

            if ($ro['type'] == 'select2') {
                if ($ro['relationship_table']) {
                    $datatable = explode(",", $ro['datatable'])[0];

                    $foreignKey2 = CRUDBooster::getForeignKey($datatable, $ro['relationship_table']);
                    $foreignKey = CRUDBooster::getForeignKey($this->table, $ro['relationship_table']);
                    DB::table($ro['relationship_table'])->where($foreignKey, $id)->delete();

                    if ($inputdata) {
                        foreach ($inputdata as $input_id) {
                            $relationship_table_pk = CB::pk($ro['relationship_table']);
                            DB::table($ro['relationship_table'])->insert([
//                                 $relationship_table_pk => CRUDBooster::newId($ro['relationship_table']),
                                $foreignKey => $id,
                                $foreignKey2 => $input_id,
                            ]);
                        }
                    }
                }
            }

            if ($ro['type'] == 'child') {
                $name = str_slug($ro['label'], '');
                $columns = $ro['columns'];
                $getColName = Request::get($name.'-'.$columns[0]['name']);
                $count_input_data = ($getColName)?(count($getColName) - 1):0;
                $child_array = [];
                $childtable = CRUDBooster::parseSqlTable($ro['table'])['table'];
                $fk = $ro['foreign_key'];

                DB::table($childtable)->where($fk, $id)->delete();
                $lastId = CRUDBooster::newId($childtable);
                $childtablePK = CB::pk($childtable);

                for ($i = 0; $i <= $count_input_data; $i++) {

                    $column_data = [];
                    $column_data[$childtablePK] = $lastId;
                    $column_data[$fk] = $id;
                    foreach ($columns as $col) {
                        $colname = $col['name'];
                        $column_data[$colname] = Request::get($name.'-'.$colname)[$i];
                    }
                    $child_array[] = $column_data;

                    $lastId++;
                }

                $child_array = array_reverse($child_array);

                DB::table($childtable)->insert($child_array);
            }
        }

        $this->hook_after_edit($id);

        $this->return_url = CRUDBooster::adminPath($slug='lap_awas_rekomend').'?return_url='.CRUDBooster::adminPath($slug='lap_awas_temuan/edit').'/'.$id.'&parent_table=t_lap_awas_temuan&parent_columns=judul&parent_columns_alias=Judul Temuan&parent_id='.$id.'&foreign_key=id_temuan&label=Rekomendasi';

        //insert log
        $old_values = json_decode(json_encode($row), true);
        CRUDBooster::insertLog(trans("crudbooster.log_update", [
            'name' => $this->arr[$this->title_field],
            'module' => CRUDBooster::getCurrentModule()->name,
        ]), LogsController::displayDiff($old_values, $this->arr));

        return redirect($this->return_url);
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
            unset($postdata['id_up']);
            unset($postdata['id_up2']);
            unset($postdata['Id_up_sebab']);
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
            unset($postdata['id_up']);
            unset($postdata['id_up2']);
            unset($postdata['Id_up_sebab']);
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
