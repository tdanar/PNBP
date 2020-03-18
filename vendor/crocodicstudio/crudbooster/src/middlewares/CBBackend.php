<?php

namespace crocodicstudio\crudbooster\middlewares;

use Closure;
use CRUDBooster;
use DB;
use Route;
use Request;

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
        `t_lap_awas`.`id_status_kirim`,
        `t_lap_awas_temuan`.`id` AS `id_temuan`,
        `t_lap_awas_rekomend`.`id` AS `id_rekomend`')->
        leftjoin('t_lap_awas_temuan','t_lap_awas_temuan.id_lap','=','t_lap_awas.id')->
        leftjoin('t_lap_awas_rekomend','t_lap_awas_temuan.id','=','t_lap_awas_rekomend.id_temuan')->
        where('id_user',CRUDBooster::myId())->get();
        $module = CRUDBooster::getCurrentModule()->path;
        $adminPathSegments = count(explode('/', config('crudbooster.ADMIN_PATH')));
        $extModule = Request::segment(1 + $adminPathSegments);
        $extModCol = ['validasi','kirim'];
        $extModCol3 = ['excel','batal'];
        $extModCol4 = [];


        $colModule = collect([
            ['module' => 'lap_awas', 'key' => 'id'],
            ['module' => 'lap_awas_temuan', 'key' => 'id_temuan'],
            ['module' => 'lap_awas_rekomend', 'key' => 'id_rekomend'],
            ['module' => 'monitoring', 'key' => 'id'],
        ]);
        //dd($colModule->where('module',$module)->flatten(1)[0]);

        //dd(strpos($stringmodule,$module->path));
        if ($colModule->where('module',$module)->flatten(1)[0]) {
            $m = $colModule->where('module',$module)->flatten(1)[0];
            $k = $colModule->where('module',$module)->flatten(1)[1];


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
                if(!CRUDBooster::isSuperadmin()){
                    if($data->whereIn($k,$id)->isEmpty()){
                        abort(404);
                    }
                }

            }


            if(CRUDBooster::getCurrentMethod() == 'getDetail'){

                $id = CRUDBooster::getCurrentId();
                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){
                    if($data->whereIn($k,$id)->isEmpty()){
                        abort(404);
                    }
                }

            }

            if(CRUDBooster::getCurrentMethod() == 'getDlPDF'){

                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3 && CRUDBooster::myPrivilegeId() != 4){

                        abort(404);

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

                if(!CRUDBooster::isSuperadmin()){
                    if($data->whereIn('id',$id)->isEmpty()){
                        abort(404);
                    }
                }
        }

        if(in_array($extModule,$extModCol3)){
            $id = intval(Request::segment(3));

                if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != 3){
                    if($data->whereIn('id',$id)->isEmpty()){
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
        if (CRUDBooster::isLocked()) {
            $url = url($admin_path.'/lock-screen');

            return redirect($url);
        }

        return $next($request);
    }
}
