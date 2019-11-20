<?php namespace App\Http\Controllers;

	use Session;
	use DB;
    use CRUDBooster;
    use Excel;
	use Request;
    use Response;
    use DataTables;
	use Illuminate\Http\Request as Rikues;

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
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
            $this->button_export = false;
            $this->button_addmore = false;
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
			$this->form[] = ['label'=>'Tahun Pengawasan','name'=>'tahun','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-5','dataenum'=>((now()->year)-4).';'.((now()->year)-3).';'.((now()->year)-2).';'.((now()->year)-1).';'.((now()->year)),"default" => "Silahkan pilih tahun dilaksanakannya pengawasan","title"=>"Silahkan pilih tahun dilaksanakannya pengawasan"];
			$this->form[] = ['label'=>'No. Laporan','name'=>'no_lap','type'=>'text','validation'=>'required|min:1|max:255|unique:t_lap_awas,no_lap,id','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Laporan','name'=>'tanggal','type'=>'date','validation'=>'required','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Nama Keg. Pengawasan','name'=>'nama_giat_was','type'=>'text','validation'=>'required|min:1|max:300','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Periode Pengawasan','type'=>'label'];
			$this->form[] = ['label'=>'Tahun Mulai','name'=>'thn_mulai','type'=>'select','validation'=>'required','width'=>'col-sm-5','dataenum'=>((now()->year)-4).';'.((now()->year)-3).';'.((now()->year)-2).';'.((now()->year)-1).';'.((now()->year)),"default" => "Silahkan pilih tahun awal periode pengawasan","title"=>"Silahkan pilih tahun awal periode pengawasan"];
			$this->form[] = ['label'=>'Tahun Usai','name'=>'thn_usai','type'=>'select','validation'=>'required','width'=>'col-sm-5','dataenum'=>((now()->year)-4).';'.((now()->year)-3).';'.((now()->year)-2).';'.((now()->year)-1).';'.((now()->year)),"default" => "Silahkan pilih tahun akhir periode pengawasan","title"=>"Silahkan pilih tahun akhir periode pengawasan"];
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
            //$this->addaction[] = ['label'=>'Export Word','url'=>'/files/PNBPeksport.docx', 'icon'=>'fa fa-file-word-o'];
            //$this->addaction[] = ['label'=>'Export Excel','url'=>'/files/PNBPeksport.xlsx', 'icon'=>'fa fa-file-excel-o'];

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
            //$this->index_button = array();
            $this->index_button[] = ['label'=>'Import dari Excel','url'=>'/ma/importAwas','icon'=>'fa fa-upload','indexonly' => 'true'];
            $this->index_button[] = ['label'=>'Export ke Excel','url'=>'#','icon'=>'fa fa-download','indexonly' => 'true'];



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

        public function import()
    {
        return view('lapAwasImport');
    }

        public function importExcel(Rikues $request)
    {
        if($request->hasFile('import_file')){
            Excel::selectSheetsByIndex(0)->load($request->file('import_file')->getRealPath(), function ($reader) {
                $datas = $reader->skipRows(1)->toArray();
                //dd($datas);
				$notnull = array_filter($datas, function($v) { return !empty($v['no']) || !empty($v['judul_temuan']) || !empty($v['rekomendasi']); });

				/* if($notnull[0]['nomor_laporan'] === NULL){
					$notnull[0] = "defaultValue";
				  } */

				  for($i=1; $i < count($notnull); $i++){
					if($notnull[$i]['nomor_laporan'] === NULL){
					  $notnull[$i]['nomor_laporan'] = $notnull[$i-1]['nomor_laporan'];

					  if($notnull[$i]['judul_temuan'] === NULL){
						$notnull[$i]['judul_temuan'] = $notnull[$i-1]['judul_temuan'];
					  }
					  $notnullsip = array_filter($notnull, function($v) { return !empty($v['no']) || !empty($v['rekomendasi']); });
					}
				  }
				//dd($notnullsip);
                foreach ($notnullsip as $key => $row) {
                    $data['id_user'] = CRUDBooster::myId();
                    $data['id_status_kirim'] = 1;
                    $data['tahun'] = $row['tahun_mulai'];
                    $data['no_lap'] = $row['nomor_laporan'];
                    $data['tanggal'] = $row['tanggal'];
                    $data['nama_giat_was'] = $row['nama_kegiatan_pengawasan'];
                    $data['thn_mulai'] = $row['tahun_mulai'];
                    $data['thn_usai'] = $row['tahun_selesai'];
                    switch(true) {
                        case $row['jenis_pengawasan'] = "Audit":
                            $data['id_jenis_was'] = 1;
                        break;
                        case $row['jenis_pengawasan'] = "Reviu":
                            $data['id_jenis_was'] = 2;
                        break;
                        case $row['jenis_pengawasan'] = "Monitoring":
                            $data['id_jenis_was'] = 3;
                        break;
                        case $row['jenis_pengawasan'] = "Evaluasi":
                            $data['id_jenis_was'] = 4;
                        break;
                    }
					$data['created_at'] = now();
                    //dd($data);
					$nolapexist = DB::table('t_lap_awas')->select('no_lap')->where('no_lap',$data['no_lap'])->first();

                    if(!empty($row['no']) && !empty($data['tahun']) && empty($nolapexist)) {
						DB::table('t_lap_awas')->insert($data);
					}
					if(!empty($row['no']) && !empty($data['tahun']) && !empty($nolapexist)) {
                        DB::table('t_lap_awas')->where('no_lap',$data['no_lap'])->update($data);
                    }
				}
				foreach($notnullsip as $key => $row2){
						$no_lap = $row2['nomor_laporan'];
						$id_lap = DB::table('t_lap_awas')->select('id')->where('no_lap',$no_lap)->first();
						$data2['id_lap'] = $id_lap->id;
                        $data2['judul'] = $row2['judul_temuan'];
						$data2['lokasi'] = $row2['lokasi_pengawasan'];
						$data2['id_kod_temuan'] = $row2['klasifikasi_temuan'];
						$data2['kondisi'] = $row2['kondisi'];
						$data2['id_mata_uang'] = $row2['mata_uang'];
						$data2['nilai_uang'] = $row2['nilai'];
						$data2['sebab'] = $row2['sebab'];
						$data2['id_kod_sebab'] = $row2['klasifikasi_sebab'];
						$data2['akibat'] = $row2['akibat'];
						$data2['created_at'] = now();

						$temuanexist = DB::table('t_lap_awas_temuan')->select('id')->where('judul',$data2['judul'])->count();
                        //dd($data2);
						 if(!empty($data2) && !empty($data2['id_kod_temuan']) && $temuanexist === 0){
                            DB::table('t_lap_awas_temuan')->insert($data2);
                        }
                        if(!empty($data2) && !empty($data2['id_kod_temuan']) && $temuanexist > 0){
                            DB::table('t_lap_awas_temuan')->where('judul',$data2['judul'])->delete();
                            DB::table('t_lap_awas_temuan')->insert($data2);
                        }


                }
                foreach($notnullsip as $key => $row3){
                    $no_lap = $row3['nomor_laporan'];
                    $id_temuan = DB::table('t_lap_awas_temuan')->select('id')->where('judul',$row3['judul_temuan'])->first();
                    $data3['id_temuan'] = $id_temuan->id;
                    $data3['rekomendasi'] = $row3['rekomendasi'];
                    $data3['id_kod_rekomendasi'] = (int) substr($row3['klasifikasi_rekomendasi'],0,2);
                    $data3['tl'] = $row3['progres_tl'];
                    $data3['status_tl'] = $row3['status_tl'];
                    $data3['id_kod_tl'] = (int) substr($row3['klasifikasi_tl'],0,2);
                    if(!empty($row3['tgl_tl'])){
                        $data3['tgl_tl'] = $row3['tgl_tl'];
                    }else{
                        $data3['tgl_tl'] = now();
                    }
                    $data3['created_at'] = now();

                    $rekexist = DB::table('t_lap_awas_rekomend')->select('id')->where('tl',$data3['tl'])->count();
                    //dd($data3);
                     if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist === 0){
                        DB::table('t_lap_awas_rekomend')->insert($data3);
                    }
                    if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist > 0){
                        DB::table('t_lap_awas_rekomend')->where('tl',$data3['tl'])->delete();
                        DB::table('t_lap_awas_rekomend')->insert($data3);
                    }


            }

            });
        }

        return redirect('/ma/lap_awas')->with('status','File Anda sudah berhasil diunggah ke database!');
    }
         public function getIndex() {
            //First, Add an auth
             if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

             //Create your own query
             $data = [];
             $data['page_title'] = 'Laporan Pengawasan PNBP';
             if(!CRUDBooster::isSuperadmin()){
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
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                where('id_user',CRUDBooster::myId())->orderby('id','desc')->
                get();
             }else{
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
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                orderby('id','desc')->
                get();
             }


            //dd($data);

             //Create a view. Please use `cbView` method instead of view method from laravel.
             $this->cbView('lapAwas',$data);
    }

    public function getDetail($id) {
        //First, Add an auth
         if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

         //Create your own query
         $data = [];
         $data['page_title'] = 'Laporan Pengawasan PNBP';
         $data['first'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
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
         `t_lap_awas_rekomend`.`rekomendasi`')->
         leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
         leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
         leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
         leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
         leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
         leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
         leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
         leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
         leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
         where('t_lap_awas.id',$id)->first();

        $data['second'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
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
            `t_lap_awas_temuan`.`lokasi`,
            `t_lap_awas_temuan`.`kondisi`,
            `t_lap_awas_temuan`.`sebab`,
            `t_lap_awas_temuan`.`akibat`,
            `t_ref_matauang`.`kode` AS `KodeMatauang`,
            `t_ref_matauang`.`deskripsi` AS `DeskMatauang`,
            `t_ref_statkirim`.`status` AS `StatKirim`,
            `t_lap_awas_temuan`.`nilai_uang`')->
            leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
            leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
            where('t_lap_awas_temuan.id_lap',$id)->get();

            $data['third'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
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
            `t_lap_awas_rekomend`.`tgl_tl`,
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
            leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
            where('t_lap_awas_temuan.id_lap',$id)->get();

        //dd($data);

         //Create a view. Please use `cbView` method instead of view method from laravel.
         $this->cbView('lapDetailAwas',$data);
}

	    public function getDataWas() {
		    if(Session::has('admin_id')){
			if(!CRUDBooster::isSuperadmin()){
                $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
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
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                where('id_user',CRUDBooster::myId())->orderby('id','desc')->
                get()->toArray();
                // $data['recordsTotal'] = $data['data']->count();
                // $data['recordsFiltered'] = $data['data']->count();
                // $data['draw'] = 1;
             }else{
                $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
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
                `t_lap_awas_rekomend`.`rekomendasi`')->
                leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                orderby('id','desc')->
                get()->toArray();
                // $data['recordsTotal'] = $data['data']->count();
                // $data['recordsFiltered'] = $data['data']->count();
                // $data['draw'] = 1;
			 	}
				return Datatables::of($data)->make(true);
			}else{
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			};

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
			setlocale(LC_ALL, 'ind_ind');
			$tanggal = strtotime($postdata['tanggal']);
            $postdata['tanggal'] = date('Y-m-d',$tanggal);

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
