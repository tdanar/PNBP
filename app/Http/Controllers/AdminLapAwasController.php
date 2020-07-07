<?php namespace App\Http\Controllers;

	use Session;
	use DB;
    use CRUDBooster;
    use Excel;
    use Illuminate\Support\Arr;
    use Rap2hpoutre\FastExcel\FastExcel;
	use Request;
    use Response;
    use DataTables;
    use Schema;
    use File;
    use crocodicstudio\crudbooster\controllers\LogsController;
    use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
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
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
            $this->button_export = false;
            $this->button_addmore = false;
            $this->label_add_button = "Tambah Laporan";
            $this->button_addtemuan = true;
            $this->button_addtemuan_label = "Simpan dan Tambah Temuan";
            $this->button_edittemuan_label = "Edit Temuan";
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
            Session::forget('current_row_id');
            $id = CRUDBooster::getCurrentId();
            $row = CRUDBooster::first($this->table,$id);
            //dd($id);
            # START FORM DO NOT REMOVE THIS LINE
            $periode = view('partials.periode', compact('row'))->render();
			$this->form = [];
			$this->form[] = ['label'=>'Tahun Pengawasan','name'=>'tahun','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-5','dataenum'=>((now()->year)-4).';'.((now()->year)-3).';'.((now()->year)-2).';'.((now()->year)-1).';'.((now()->year)),"default" => "Pilih tahun dilaksanakannya pengawasan","title"=>"Silahkan pilih tahun dilaksanakannya pengawasan"];
			$this->form[] = ['label'=>'No. Laporan','name'=>'no_lap','type'=>'text','validation'=>'required|min:1|max:255|unique:t_lap_awas,no_lap,id','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Laporan','name'=>'tanggal','type'=>'date','validation'=>'required','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Judul Keg. Pengawasan','name'=>'nama_giat_was','type'=>'text','validation'=>'required|min:1|max:300','width'=>'col-sm-10'];
            $this->form[] = ['label'=>'Jenis Pengawasan','name'=>'id_jenis_was','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'t_ref_jenis_awas,jenis_awas',"default" => "Pilih Jenis Pengawasan"];
            $this->form[] = ['label'=>'Periode Pengawasan','type'=>'label'];
            $this->form[] = ['label'=>'Periode','name'=>'thn_mulai','type'=>'custom','html'=>$periode,'validation'=>'required|integer|min:0'];
			// $this->form[] = ['label'=>'Periode','name'=>'thn_mulai','type'=>'select','validation'=>'required','width'=>'col-sm-5',"default" => "Pilih tahun awal periode yang diawasi","title"=>"Silahkan pilih tahun awal periode pengawasan"];
			// $this->form[] = ['label'=>'-','name'=>'thn_usai','type'=>'select','validation'=>'required','width'=>'col-sm-5',"default" => "Pilih tahun akhir periode yang diawasi","title"=>"Silahkan pilih tahun akhir periode pengawasan"];
            $this->form[] = ['label'=>'File PDF Laporan','name'=>'filename','type'=>'upload','validation'=>'required|mimes:pdf|max:20000','upload_encrypt'=>false, 'accept'=>'.pdf',"help"=>"Maksimum ukuran file 20MB"];
            $this->form[] = ['label'=>'Id User','name'=>'id_user','type'=>'hidden','value' => CRUDBooster::myId()];
            $this->form[] = ['label'=>'Status Kirim','name'=>'id_status_kirim','type'=>'hidden','value' => 1];

            //dd($this->form[5]['value']);

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
            if (CRUDBooster::isCreate()){
             $this->index_button[] = ['label'=>'Import dari Excel','url'=>'/ma/importAwas','icon'=>'fa fa-upload','indexonly' => 'true'];
            }
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

    public function getEdit($id){

        $this->button_addmore = FALSE;
		$this->button_cancel  = TRUE;
		$this->button_show    = FALSE;
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;
        $this->hide_form 	  = ['no_lap'];





        $data['page_title'] = 'Edit Laporan Pengawasan PNBP';
        $data['row']        = CRUDBooster::first('t_lap_awas',$id);

        $data['command']    = 'edit';


		$this->cbView('crudbooster::default.form',$data);
    }

        public function import()
    {
        return view('lapAwasImport');
    }

        public function importExcel(Rikues $request)
    {
        if($request->hasFile('import_file')){
            $ext = $request->import_file->getClientOriginalExtension();
            //dd($request->import_file->getClientOriginalExtension());
        if ($ext === 'xls' || $ext === 'xlsx'){
            $request->validate([
                'import_file' => 'required|mimes:xls,xlsx|max:10000'
            ]);

            $path = $request->file('import_file')->getRealPath();

            Excel::selectSheetsByIndex(0)->load($path, function ($reader) {
                $datas = $reader->skipRows(1)->toArray();

				$notnull = array_filter($datas, function($v) { return !empty($v['no']) || !empty($v['judul_temuan']) || !empty($v['rekomendasi']); });


                  //dd($notnull);
                  if (count($notnull)===1 || count($notnull)===0) {
                    $notnullsip = $notnull;
                  }else{
                    $rearray = array_values($notnull);
                    for($i=1; $i < count($rearray); $i++){
                        if($rearray[$i]['nomor_laporan'] === NULL){
                        $rearray[$i]['nomor_laporan'] = $rearray[$i-1]['nomor_laporan'];
                        $rearray[$i]['lokasi_pengawasan'] = $rearray[$i-1]['lokasi_pengawasan'];


                            if($rearray[$i]['judul_temuan'] === NULL){
                                $rearray[$i]['judul_temuan'] = $rearray[$i-1]['judul_temuan'];

                            }
                        }
                        $notnullsip = array_filter($rearray, function($v) { return !empty($v['no']) || !empty($v['rekomendasi']); });

                    }

                  }
                //dd($notnullsip);

                foreach ($notnullsip as $key => $row) {
                    $data['id_user'] = CRUDBooster::myId();
                    $data['id_status_kirim'] = 1;
                    $data['tahun'] = $row['tahun_selesai'];
                    $data['no_lap'] = strip_tags($row['nomor_laporan']);
                    $data['tanggal'] = $row['tanggal'];
                    $data['nama_giat_was'] = strip_tags($row['nama_kegiatan_pengawasan']);
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

					if(!empty($row['no']) && !empty($nolapexist)) {

                        CRUDBooster::redirect(CRUDBooster::adminPath($slug='lap_awas'), 'Nomor laporan: "'.strip_tags($row['nomor_laporan']).'" telah ada, mohon memasukkan laporan yang belum diinput.', 'warning');
                        die;
                    }
                    if(!empty($row['no']) && empty($nolapexist)) {
                        DB::table('t_lap_awas')->insert($data);
                        $no_lap = strip_tags($row['nomor_laporan']);
						$id_lap = DB::table('t_lap_awas')->select('id')->where('no_lap',$no_lap)->first();
						$data2['id_lap'] = $id_lap->id;
                        $data2['judul'] = strip_tags($row['judul_temuan']);
						$data2['lokasi'] = strip_tags($row['lokasi_pengawasan']);
						$data2['id_kod_temuan'] = $row['klasifikasi_temuan'];
						$data2['kondisi'] = strip_tags($row['kondisi']);
						$data2['id_mata_uang'] = $row['mata_uang'];
						$data2['nilai_uang'] = $row['nilai'];
						$data2['sebab'] = strip_tags($row['sebab']);
						$data2['id_kod_sebab'] = $row['klasifikasi_sebab'];
						$data2['akibat'] = strip_tags($row['akibat']);
                        $data2['created_at'] = now();

                        $temuanexist = DB::table('t_lap_awas_temuan')->select('id')->where('judul',$data2['judul'])->count();
						 if(!empty($data2) && !empty($data2['id_kod_temuan']) && $temuanexist == 0){
                            DB::table('t_lap_awas_temuan')->insert($data2);
                        }
                        if(!empty($data2) && !empty($data2['id_kod_temuan']) && $temuanexist > 0){
                            DB::table('t_lap_awas_temuan')->where('id_lap',$data2['id_lap'])->where('judul',$data2['judul'])->delete();
                            DB::table('t_lap_awas_temuan')->insert($data2);

                        }

                        $id_temuan = DB::table('t_lap_awas_temuan')->select('id')->where('id_lap',$id_lap->id)->where('judul',strip_tags($row['judul_temuan']))->first();
                        $data3['id_temuan'] = $id_temuan->id;
                        $data3['rekomendasi'] = strip_tags($row['rekomendasi']);
                        $data3['id_kod_rekomendasi'] = (int) substr($row['klasifikasi_rekomendasi'],0,2);
                        $data3['tl'] = strip_tags($row['progres_tl']);
                        $data3['id_kod_tl'] = (int) substr($row['klasifikasi_tl'],0,2);
                        if(!empty($row['tgl_tl'])){
                            $data3['tgl_tl'] = $row['tgl_tl'];
                        }else{
                            $data3['tgl_tl'] = now();
                        }
                        $data3['created_at'] = now();

                        $rekexist = DB::table('t_lap_awas_rekomend')->select('id')->where('tl',$data3['tl'])->count();
                        if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist == 0){
                            DB::table('t_lap_awas_rekomend')->insert($data3);
                        }
                        if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist > 0){
                            DB::table('t_lap_awas_rekomend')->where('id_temuan',$data3['id_temuan'])->where('tl',$data3['tl'])->delete();
                            DB::table('t_lap_awas_rekomend')->insert($data3);

                        }
                    }
                    if(empty($row['no'])){
                        $no_lap = strip_tags($row['nomor_laporan']);
						$id_lap = DB::table('t_lap_awas')->select('id')->where('no_lap',$no_lap)->first();
                        if($id_lap){
                            if(!empty($row['klasifikasi_temuan'])){
                                $no_lap = strip_tags($row['nomor_laporan']);
                                $id_lap = DB::table('t_lap_awas')->select('id')->where('no_lap',$no_lap)->first();
                                $data2['id_lap'] = $id_lap->id;
                                $data2['judul'] = strip_tags($row['judul_temuan']);
                                $data2['lokasi'] = strip_tags($row['lokasi_pengawasan']);
                                $data2['id_kod_temuan'] = $row['klasifikasi_temuan'];
                                $data2['kondisi'] = strip_tags($row['kondisi']);
                                $data2['id_mata_uang'] = $row['mata_uang'];
                                $data2['nilai_uang'] = $row['nilai'];
                                $data2['sebab'] = strip_tags($row['sebab']);
                                $data2['id_kod_sebab'] = $row['klasifikasi_sebab'];
                                $data2['akibat'] = strip_tags($row['akibat']);
                                $data2['created_at'] = now();

                                $temuanexist = DB::table('t_lap_awas_temuan')->select('id')->where('judul',$data2['judul'])->count();
                                if(!empty($data2) && !empty($data2['id_kod_temuan']) && $temuanexist == 0){
                                    DB::table('t_lap_awas_temuan')->insert($data2);
                                }
                                if(!empty($data2) && !empty($data2['id_kod_temuan']) && $temuanexist > 0){
                                    DB::table('t_lap_awas_temuan')->where('id_lap',$data2['id_lap'])->where('judul',$data2['judul'])->delete();
                                    DB::table('t_lap_awas_temuan')->insert($data2);

                                }

                                $id_temuan = DB::table('t_lap_awas_temuan')->select('id')->where('id_lap',$id_lap->id)->where('judul',strip_tags($row['judul_temuan']))->first();
                                $data3['id_temuan'] = $id_temuan->id;
                                $data3['rekomendasi'] = strip_tags($row['rekomendasi']);
                                $data3['id_kod_rekomendasi'] = (int) substr($row['klasifikasi_rekomendasi'],0,2);
                                $data3['tl'] = strip_tags($row['progres_tl']);
                                $data3['id_kod_tl'] = (int) substr($row['klasifikasi_tl'],0,2);
                                if(!empty($row['tgl_tl'])){
                                    $data3['tgl_tl'] = $row['tgl_tl'];
                                }else{
                                    $data3['tgl_tl'] = now();
                                }
                                $data3['created_at'] = now();

                                $rekexist = DB::table('t_lap_awas_rekomend')->select('id')->where('tl',$data3['tl'])->count();
                                if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist == 0){
                                    DB::table('t_lap_awas_rekomend')->insert($data3);
                                }
                                if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist > 0){
                                    DB::table('t_lap_awas_rekomend')->where('id_temuan',$data3['id_temuan'])->where('tl',$data3['tl'])->delete();
                                    DB::table('t_lap_awas_rekomend')->insert($data3);

                                }
                            }else{
                                $no_lap = strip_tags($row['nomor_laporan']);
                                $id_lap = DB::table('t_lap_awas')->select('id')->where('no_lap',$no_lap)->first();
                                $id_temuan = DB::table('t_lap_awas_temuan')->select('id')->where('id_lap',$id_lap->id)->where('judul',strip_tags($row['judul_temuan']))->first();
                                $data3['id_temuan'] = $id_temuan->id;
                                $data3['rekomendasi'] = strip_tags($row['rekomendasi']);
                                $data3['id_kod_rekomendasi'] = (int) substr($row['klasifikasi_rekomendasi'],0,2);
                                $data3['tl'] = strip_tags($row['progres_tl']);
                                $data3['id_kod_tl'] = (int) substr($row['klasifikasi_tl'],0,2);
                                if(!empty($row['tgl_tl'])){
                                    $data3['tgl_tl'] = $row['tgl_tl'];
                                }else{
                                    $data3['tgl_tl'] = now();
                                }
                                $data3['created_at'] = now();

                                $rekexist = DB::table('t_lap_awas_rekomend')->select('id')->where('tl',$data3['tl'])->count();
                                if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist == 0){
                                    DB::table('t_lap_awas_rekomend')->insert($data3);
                                }
                                if(!empty($data3) && !empty($data3['id_kod_rekomendasi']) && $rekexist > 0){
                                    DB::table('t_lap_awas_rekomend')->where('id_temuan',$data3['id_temuan'])->where('tl',$data3['tl'])->delete();
                                    DB::table('t_lap_awas_rekomend')->insert($data3);

                                }
                            }
                        }
                    }
                }

            });
            CRUDBooster::redirect(CRUDBooster::adminPath($slug='lap_awas'), 'File Excel Anda sudah berhasil diunggah ke database!', 'success');
            die;
        }else if ($ext === 'csv'){
            $request->validate([
                'import_file' => 'required|max:10000'
            ]);
            CRUDBooster::redirect(CRUDBooster::mainpath(), 'File CSV Anda sudah berhasil diunggah ke database!', 'success');
        }else{
            $backlink = CRUDBooster::adminPath($slug='importAwas');
            CRUDBooster::redirect($backlink, 'Maaf! Tidak menerima file selain xlsx, xlx, dan csv', 'warning');
        }
        }else{
            $backlink = CRUDBooster::adminPath($slug='importAwas');
            CRUDBooster::redirect($backlink, 'Terjadi kesalahan! Harus ada file yang diunggah.', 'warning');

        }

    }


         public function getIndex() {
            //First, Add an auth
             if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

             //Create your own query
             $data = [];
             $data['page_title'] = 'Laporan Pengawasan PNBP';
             if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeId() == 3){
                $data['result'] = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
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
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                where('id_status_kirim',2)->
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
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                where('id_user',CRUDBooster::myId())->orderby('id','desc')->
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
            `t_lap_awas_rekomend`.`rekomendasi`')->
            join('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
            join('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
            join('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
            join('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
            join('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
            join('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
            join('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
            join('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
            join('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
            where('t_lap_awas_temuan.id_lap',$id)->get();

            $detail['countTemuan'] = DB::table('t_lap_awas_temuan')->where('id_lap',$id)->count();
            $detail['countRekomend'] = DB::table('t_lap_awas_rekomend')->join('t_lap_awas_temuan','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('id_lap',$id)->count();


        //dd($detail);

         //Create a view. Please use `cbView` method instead of view method from laravel.
            $this->cbView('lapDetailAwas',$detail);

}

        public function getDataWas() {
            if(Session::has('admin_id')){
            if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeId() == 3){
                $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
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
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
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
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                orderby('id','desc')->
                where('id_status_kirim',2)->
                get()->toArray();
                // $data['recordsTotal'] = $data['data']->count();
                // $data['recordsFiltered'] = $data['data']->count();
                // $data['draw'] = 1;
            }
            else{
                $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id_user`,
                `t_lap_awas`.`tahun`,
                `t_ref_unit`.`unit`,
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
                leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
                leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                where('id_user',CRUDBooster::myId())->orderby('id','desc')->
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


        public function exporExcel($id){
            if(!Session::has('admin_id')) CRUDBooster::redirect(CRUDBooster::adminPath($slug='lap_awas'),trans('crudbooster.denied_access'));
                $detail = DB::table('t_lap_awas')->selectRaw('
                    `cms_users`.`name` AS `inputer`,
                    `t_lap_awas`.`tahun`,
                    `t_lap_awas`.`thn_mulai`,
                    `t_lap_awas`.`thn_usai`,
                    `t_lap_awas`.`no_lap`,
                    `t_lap_awas`.`tanggal`,
                    `t_lap_awas`.`nama_giat_was`,
                    `t_ref_statkirim`.`status` AS `StatKirim`,
                    substring_index(`t_lap_awas`.`filename`, "/", -1) AS namafile,
                    `t_ref_jenis_awas`.`jenis_awas`,
                    `t_lap_awas`.`created_at`,
                    `t_lap_awas`.`updated_at`,
                    `t_lap_awas_temuan`.`id` AS `id_temuan`,
                    `t_ref_kod_temuan`.`Deskripsi` AS `jenis_temuan`,
                    `t_lap_awas_temuan`.`judul` AS `judul_temuan`,
                    `t_lap_awas_temuan`.`kondisi`,
                    `t_ref_kod_sebab`.`Deskripsi` AS `jenis_sebab`,
                    `t_lap_awas_temuan`.`sebab`,
                    `t_lap_awas_temuan`.`akibat`,
                    `t_ref_matauang`.`kode` AS `KodeMatauang`,
                    `t_lap_awas_temuan`.`nilai_uang`,
                    `t_ref_kod_rekomendasi`.`Deskripsi` AS `jenis_rekomendasi`,
                    `t_lap_awas_rekomend`.`rekomendasi`,
                    `t_lap_awas_rekomend`.`tgl_tl`,
                    `t_ref_tl`.`deskripsi` AS `KodTL`,
                    `t_lap_awas_rekomend`.`tl` AS `tindak_lanjut`')->
                    leftjoin('cms_users','t_lap_awas.id_user','=','cms_users.id')->
                    leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                    leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                    leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                    leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                    leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                    leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                    leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                    leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                    leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                    where('t_lap_awas.id',$id)->get();




            //dd($detail);
            try {
                return (new FastExcel($detail))->download('ekspor_lap_pnbp_'.$id.'_'.date("d-m-Y").'.xlsx');
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        }

        public function exporWord($id){
            if(!Session::has('admin_id')) CRUDBooster::redirect(CRUDBooster::adminPath($slug='lap_awas'),trans('crudbooster.denied_access'));
                $detail = DB::table('t_lap_awas')->selectRaw('
                    `cms_users`.`name` AS `inputer`,
                    `t_lap_awas`.`tahun`,
                    `t_ref_unit`.`unit`,
                    `t_lap_awas`.`thn_mulai`,
                    `t_lap_awas`.`thn_usai`,
                    `t_lap_awas`.`no_lap`,
                    `t_lap_awas`.`tanggal`,
                    `t_lap_awas`.`nama_giat_was`,
                    `t_ref_statkirim`.`status` AS `StatKirim`,
                    substring_index(`t_lap_awas`.`filename`, "/", -1) AS namafile,
                    `t_ref_jenis_awas`.`jenis_awas`,
                    `t_lap_awas`.`created_at`,
                    `t_lap_awas`.`updated_at`,
                    `t_lap_awas_temuan`.`id` AS `id_temuan`,
                    `t_ref_kod_temuan`.`Deskripsi` AS `jenis_temuan`,
                    `t_lap_awas_temuan`.`judul` AS `judul_temuan`,
                    `t_lap_awas_temuan`.`kondisi`,
                    `t_ref_kod_sebab`.`Deskripsi` AS `jenis_sebab`,
                    `t_lap_awas_temuan`.`sebab`,
                    `t_lap_awas_temuan`.`akibat`,
                    `t_ref_matauang`.`kode` AS `KodeMatauang`,
                    `t_lap_awas_temuan`.`nilai_uang`,
                    `t_ref_kod_rekomendasi`.`Deskripsi` AS `jenis_rekomendasi`,
                    `t_lap_awas_rekomend`.`rekomendasi`,
                    `t_lap_awas_rekomend`.`tgl_tl`,
                    `t_ref_tl`.`deskripsi` AS `KodTL`,
                    `t_lap_awas_rekomend`.`tl` AS `tindak_lanjut`')->
                    leftjoin('cms_users','t_lap_awas.id_user','=','cms_users.id')->
                    leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
                    leftjoin('t_ref_jenis_awas','t_lap_awas.id_jenis_was','=','t_ref_jenis_awas.id')->
                    leftjoin('t_ref_statkirim','t_lap_awas.id_status_kirim','=','t_ref_statkirim.id')->
                    leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
                    leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
                    leftjoin('t_ref_tl','t_lap_awas_rekomend.id_kod_tl','=','t_ref_tl.id')->
                    leftjoin('t_ref_kod_temuan','t_lap_awas_temuan.id_kod_temuan','=','t_ref_kod_temuan.id')->
                    leftjoin('t_ref_kod_sebab','t_lap_awas_temuan.id_kod_sebab','=','t_ref_kod_sebab.id')->
                    leftjoin('t_ref_matauang','t_lap_awas_temuan.id_mata_uang','=','t_ref_matauang.id')->
                    leftjoin('t_ref_kod_rekomendasi','t_lap_awas_rekomend.id_kod_rekomendasi','=','t_ref_kod_rekomendasi.id')->
                    where('t_lap_awas.id',$id)->get();



                    $phpWord = new \PhpOffice\PhpWord\PhpWord();
                    $phpWord->setDefaultFontSize(11);
                    $phpWord->setDefaultParagraphStyle(
                        array(
                            'align'      => 'left'
                            )
                        );
                        $phpWord->addParagraphStyle(
                            'rightTab',
                            array(
                                'spaceBefore' => 0,
                                'spaceAfter' => 0,
                                'indentation' => array('left' => 5040, 'right' => 120)
                            )
                        );
                    $section = $phpWord->addSection();
                    $header = $section->addHeader();

                    function paragraphOptions($align) {
                        return array('spaceBefore' => 0, 'spaceAfter' => 0, 'align'=> $align);
                    }


                    $judul = "IKHTISAR LAPORAN HASIL PENGAWASAN";
                    $unit = $detail[0]->unit;
                    $nama_giat_was = $detail[0]->nama_giat_was;
                    $no_lap = 'No. '.$detail[0]->no_lap;
                    $tanggal = \Carbon\Carbon::parse($detail[0]->tanggal)->format('d/m/Y');
                    $judulIkhtisar = "Ikhtisar Hasil Pengawasan";


                    $section->addText($judul, array('bold' => true),paragraphOptions('center'));
                    $section->addText($unit, array('bold' => true),paragraphOptions('center'));
                    $section->addText($nama_giat_was,null, paragraphOptions('center'));
                    $section->addText($no_lap.' tanggal '.$tanggal, null,paragraphOptions('center'));
                    $section->addText(' ', array('size' => 20));
                    $section->addText(' ', array('size' => 20));
                    $section->addText($judulIkhtisar,null,paragraphOptions(''));
                    $html = '<ol>';

                    foreach ($detail->unique('id_temuan') as $val){

                            $html .= '<li><strong>Judul Temuan </strong><br/>'.$val->judul_temuan.'<br/>('.$val->jenis_temuan.')
                            <ul>
                            <li><strong>Kondisi </strong><br/>'.$val->kondisi.'</li>
                            <li><strong>Sebab </strong><br/>'.$val->sebab;
                            if($val->jenis_sebab != null){
                                $html .= '<br/>('.$val->jenis_sebab.')';
                            }
                            $html .= '</li>';
                            $html .= '<li><strong>Akibat </strong><br/>'.$val->akibat.'</li>';
                            if($val->rekomendasi != null){
                                $html .='<li><strong>Rekomendasi </strong><ol>';
                                foreach($detail as $rek){
                                    if($rek->id_temuan == $val->id_temuan && $rek->rekomendasi != null){
                                        $html .= '<li>'.$rek->rekomendasi.'<br/>';
                                        if($rek->jenis_rekomendasi != null){
                                            $html .= '('.$val->jenis_sebab.')';
                                        }
                                        $html .= '</li>';
                                    }

                                }
                                $html .='</ol></li>';
                            }

                            $html .='</ul></li>';



                    };
                    $html .= '</ol>';


                    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);
                    $section->addText(' ', array('size' => 20));
                    $section->addText(' ', array('size' => 20));
                    $section->addText('Mengetahui, ', null,'rightTab');
                    $section->addText(' ', array('size' => 20));
                    $section->addText(' ', array('size' => 20));
                    $section->addText(' ', array('size' => 20));
                    $section->addText('(Pejabat Penanda Tangan Laporan) ', null,'rightTab');
                    $section->addText('NIP ', null,'rightTab');


                    //dd($detail);

                    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007', $download = true);
                    $filename = 'ekspor_lap_pnbp_'.$id.'_'.date("d-m-Y").'.docx';
                    header('Content-Disposition: attachment; filename='.$filename);
            //dd($detail);
            try {
                $objWriter->save("php://output");
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        }

        public function Validasi($id){
            $data['data'] = DB::table('t_lap_awas')->
                where('t_lap_awas.id',$id)->
                first();
            $data['kod_temuan'] = DB::table('t_lap_awas_temuan')->where('id_lap',$id)->where('id_kod_temuan','')->count();
            $data['kod_sebab'] = DB::table('t_lap_awas_temuan')->where('id_lap',$id)->where('id_kod_sebab','')->count();
            $data['kod_rekomend']=DB::table('t_lap_awas_rekomend')->selectRaw('t_lap_awas_rekomend.*')->join('t_lap_awas_temuan','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('id_lap',$id)->where('id_kod_rekomendasi','')->count();
            $data['kod_tl']=DB::table('t_lap_awas_rekomend')->selectRaw('t_lap_awas_rekomend.*')->join('t_lap_awas_temuan','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('id_lap',$id)->where('id_kod_tl','')->count();
            $data['countTemuan'] = DB::table('t_lap_awas_temuan')->where('id_lap',$id)->count();
            $data['countRekomend'] = DB::table('t_lap_awas_rekomend')->join('t_lap_awas_temuan','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->where('id_lap',$id)->count();
            $ceks = DB::table('t_lap_awas_temuan')->selectRaw('DISTINCT `t_lap_awas_temuan`.`id` AS `id_temuan`,COUNT(`t_lap_awas_rekomend`.`id`) AS `count_rek`')
            ->join('t_lap_awas','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')
            ->leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')
            ->where('t_lap_awas.id',$id)
            ->groupBy('t_lap_awas_temuan.id')
            ->get();

            foreach ($ceks as $i => $v){
                $v->count_rek == 0 ? $cek[$i] = 1 : $cek[$i] = 0;
            }
            if ($cek){
                $data['cekRek'] = array_sum($cek);
            }else{
                $data['cekRek'] = 1;
            }


            //dd($data['kod_temuan']);

            return view('modal.verifikasi',$data);

        }

        public function Kirim($id){
            try {
                DB::table('t_lap_awas')
                    ->where('id', $id)
                    ->update(['id_status_kirim' => 2]);

            return redirect('/ma/lap_awas')->with('status','Laporan telah berhasil dikirim!');
            } catch (Exception $e) {
                report ($e);
                return false;
            }

        }

        public function Batal($id){
            try {
                DB::table('t_lap_awas')
                    ->where('id', $id)
                    ->update(['id_status_kirim' => 1]);

            return redirect('/ma/lap_awas')->with('status','Laporan sudah dapat diedit kembali oleh pengguna!');
            } catch (Exception $e) {
                report ($e);
                return false;
            }
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
			/* setlocale(LC_ALL, 'ind_ind');
			$tanggal = strtotime($postdata['tanggal']);
            $postdata['tanggal'] = date('Y-m-d',$tanggal); */
            $postdata['thn_usai'] = $_POST['thn_usai'];
            $postdata['no_lap'] = strip_tags($_POST['no_lap']);
            $postdata['nama_giat_was'] = strip_tags($_POST['nama_giat_was']);

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after add public static function called
	    | ----------------------------------------------------------------------
	    | @id = last insert id
	    |
        */
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

        $this->return_url = CRUDBooster::adminPath($slug='lap_awas_temuan/add').'?return_url='.urlencode(CRUDBooster::adminPath($slug='lap_awas_temuan').'?foreign_key=id_lap&label=Temuan&parent_columns=nama_giat_was%2Cno_lap&parent_columns_alias=Nama%20Kegiatan%2CNo.%20Lap&parent_id='.$lastInsertId.'&parent_table=t_lap_awas&return_url='.urlencode(CRUDBooster::adminPath($slug='lap_awas'))).'&parent_id='.$lastInsertId.'&parent_field=id_lap';

        //insert log
        CRUDBooster::insertLog(trans("crudbooster.log_add", ['name' => $this->arr[$this->title_field], 'module' => CRUDBooster::getCurrentModule()->name]));

        if (Request::get('submit') == $this->button_addtemuan_label){
            return redirect($this->return_url);
        }else{
            CRUDBooster::redirect(CRUDBooster::mainpath(), trans("crudbooster.alert_add_data_success"), 'success');
        }


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

        $this->return_url = CRUDBooster::adminPath($slug='lap_awas_temuan').'?return_url='.CRUDBooster::adminPath($slug='lap_awas/edit').'/'.$id.'&parent_table=t_lap_awas&parent_columns=nama_giat_was,no_lap&parent_columns_alias=Nama Kegiatan,No. Lap&parent_id='.$id.'&foreign_key=id_lap&label=Temuan';

        //insert log
        $old_values = json_decode(json_encode($row), true);
        CRUDBooster::insertLog(trans("crudbooster.log_update", [
            'name' => $this->arr[$this->title_field],
            'module' => CRUDBooster::getCurrentModule()->name,
        ]), LogsController::displayDiff($old_values, $this->arr));

        if (Request::get('submit') == $this->button_edittemuan_label){
            return redirect($this->return_url);
        }else{
            CRUDBooster::redirect(CRUDBooster::mainpath(), trans("crudbooster.alert_update_data_success"), 'success');
        }
    }


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
            /* setlocale(LC_ALL, 'ind_ind');
			$tanggal = strtotime($postdata['tanggal']);
            $postdata['tanggal'] = date('Y-m-d',$tanggal); */
            $postdata['thn_usai'] = $_POST['thn_usai'];
            $postdata['nama_giat_was'] = strip_tags($_POST['nama_giat_was']);
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
            $this->delImage($id,'filename');
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
