<?php

namespace crocodicstudio\crudbooster\middlewares;

use Closure;
use CRUDBooster;
use DB;
use Route;
use Request;
use Session;

class CBBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $admin_path = config('crudbooster.ADMIN_PATH') ?: 'admin';
        $data = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id`,
        `t_lap_awas`.`id_user`,
        `t_ref_unit`.`unit`,
        `t_lap_awas`.`id_status_kirim`,
        `t_lap_awas_temuan`.`id` AS `id_temuan`,
        `t_lap_awas_rekomend`.`id` AS `id_rekomend`,
        `t_lap_awas_tlanjut`.`id` AS `id_tlanjut`')->
        leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
        leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
        leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
        leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
        leftjoin('t_lap_awas_tlanjut','t_lap_awas_rekomend.id','=','t_lap_awas_tlanjut.id_rekomendasi')->
        where('id_user',CRUDBooster::myId())->get();
        $dataAppr = DB::table('t_lap_awas')->selectRaw('`t_lap_awas`.`id`,
        `t_lap_awas`.`id_user`,
        `t_ref_unit`.`unit`,
        `cms_users`.`id_kode_unit`,
        `t_lap_awas`.`id_status_kirim`,
        `t_lap_awas_temuan`.`id` AS `id_temuan`,
        `t_lap_awas_rekomend`.`id` AS `id_rekomend`,
        `t_lap_awas_tlanjut`.`id` AS `id_tlanjut`')->
        leftjoin('cms_users','cms_users.id','=','t_lap_awas.id_user')->
        leftjoin('t_ref_unit','t_ref_unit.id','=','cms_users.id_kode_unit')->
        leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
        leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
        leftjoin('t_lap_awas_tlanjut','t_lap_awas_rekomend.id','=','t_lap_awas_tlanjut.id_rekomendasi')->
        where('unit',CRUDBooster::myUnit())->get();
        $module = CRUDBooster::getCurrentModule()->path;
        $adminPathSegments = count(explode('/', config('crudbooster.ADMIN_PATH')));
        $extModule = Request::segment(1 + $adminPathSegments);
        $extModCol = ['validasi','kirim','reviu'];
        $extModCol3 = ['excel','word','batal'];
        $extModCol4 = [];


        $colModule = collect([
            ['module' => 'lap_awas', 'key' => 'id', 'key2' => 'unit'],
            ['module' => 'lap_awas_temuan', 'key' => 'id_temuan', 'key2' => 'unit'],
            ['module' => 'lap_awas_rekomend', 'key' => 'id_rekomend', 'key2' => 'unit'],
            ['module' => 'lap_awas_tlanjut', 'key' => 'id_tlanjut', 'key2' => 'unit'],
            ['module' => 'monitoring', 'key' => 'id', 'key2' => 'unit'],
        ]);
        //dd($colModule->where('module',$module)->flatten(1)[0]);

        //dd(strpos($stringmodule,$module->path));
        if ($colModule->where('module',$module)->flatten(1)[0]) {
            $m = $colModule->where('module',$module)->flatten(1)[0];
            $k = $colModule->where('module',$module)->flatten(1)[1];
            $k2 = $colModule->where('module',$module)->flatten(1)[2];
            


            if(CRUDBooster::getCurrentMethod() == 'getIndex'){
                if($m == 'lap_awas_temuan'){
                    $id = intval($_GET['parent_id']);
                    if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){
                        if($data->whereIn('id',$id)->isEmpty()){
                            abort(404);
                        }
                    }
                }
                if($m == 'lap_awas_rekomend'){
                    $id = intval($_GET['parent_id']);
                    if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){
                        if($data->whereIn('id_temuan',$id)->isEmpty()){
                            abort(404);
                        }
                    }
                }

            }

            if(CRUDBooster::getCurrentMethod() == 'getAdd'){
                if($m == 'lap_awas_temuan'){
                    $id = intval($_GET['parent_id']);
                    if(!CRUDBooster::isSuperadmin()){
                        if($data->whereIn('id',$id)->isEmpty()){
                            abort(404);
                        }
                    }
                }
                if($m == 'lap_awas_rekomend'){
                    $id = intval($_GET['parent_id']);
                    if(!CRUDBooster::isSuperadmin()){
                        if($data->whereIn('id_temuan',$id)->isEmpty()){
                            abort(404);
                        }
                    }
                }

            }



            if(CRUDBooster::getCurrentMethod() == 'getEdit'){

                $id = CRUDBooster::getCurrentId();

                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){
                    if(CRUDBooster::myPrivilegeId() == 5){
                        if($dataAppr->whereIn($k,$id)->isEmpty()){
                            abort(404);
                        }
                    }
                    elseif($data->whereIn($k,$id)->isEmpty()){
                        abort(404);
                    }

                }

            } 


            if(CRUDBooster::getCurrentMethod() == 'getDetail'){

                $id = CRUDBooster::getCurrentId();

                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){
                    if(CRUDBooster::myPrivilegeId() == 5){
                        if($dataAppr->whereIn($k,$id)->isEmpty()){
                            abort(404);
                        }
                    }
                    elseif($data->whereIn($k,$id)->isEmpty()){
                        abort(404);
                    }

                }

            }

            if(CRUDBooster::getCurrentMethod() == 'getDlPDF'){
                $id = CRUDBooster::getCurrentId();
                $id_unit = substr($id,0,-1);

                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){
                    if(CRUDBooster::myPrivilegeId() == 5){
                        if($dataAppr->whereIn('id_kode_unit',$id_unit)->isEmpty()){
                            abort(404);
                        }
                    }else{
                            abort(404);
                    }
                }

            }

            if(CRUDBooster::getCurrentMethod() == 'getDelete'){
                $id = CRUDBooster::getCurrentId();
                if(!CRUDBooster::isSuperadmin()){
                    if($data->whereIn($k,$id)->isEmpty()){
                        abort(404);
                    }
                }

            }
        
        }
            //dd($extModule, $extModCol3, in_array($extModule,$extModCol3));
        if(in_array($extModule,$extModCol)){
            $id = intval(Request::segment(3));
            $id_unit = CRUDBooster::myUnitId();

                if(!CRUDBooster::isSuperadmin()){
                    if(CRUDBooster::myPrivilegeId() == 5 && $dataAppr->whereIn('id_kode_unit',$id_unit)->isEmpty()){
                            abort(404);

                    }else if(CRUDBooster::myPrivilegeId() != 5 && $data->whereIn('id',$id)->isEmpty()){
                        abort(404);
                    }
                }

        }

        if(in_array($extModule,$extModCol3)){
            $id = intval(Request::segment(3));

                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3){
                    if(CRUDBooster::myPrivilegeId() == 5){
                        if($dataAppr->whereIn('id',$id)->isEmpty()){
                            abort(404);
                        }
                    }elseif($data->whereIn('id',$id)->isEmpty()){
                        abort(404);
                    }
                }
        }

        if(in_array($extModule,$extModCol4)){
            $id = intval(Request::segment(3));

                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){
                    if($data->whereIn('id',$id)->isEmpty()){
                        abort(404);
                    }
                }
        }



        if (CRUDBooster::myId() == '') {
            $url = url($admin_path.'/login');

            return redirect($url)->with('message', trans('crudbooster.not_logged_in'));
        }

        $users = DB::table(config('crudbooster.USER_TABLE'))->where("id", CRUDBooster::myId())->first();
        $ran_num = 290288;
        $tohashid = $users->id.Request::server('REMOTE_ADDR').($users->id+$ran_num);
        $last_session_id = $users->session_id;

        if (CRUDBooster::myId() != '' && !\Hash::check($tohashid, $last_session_id)) {
            $url = url($admin_path.'/login');
            Session::flush();
            return redirect($url)->with('message', trans('crudbooster.not_logged_in'));
        }

        if (CRUDBooster::isLocked()) {
            $url = url($admin_path.'/lock-screen');

            return redirect($url);
        }

        return $next($request);
    }
}
