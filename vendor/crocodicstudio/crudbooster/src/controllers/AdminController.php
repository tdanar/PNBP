<?php namespace crocodicstudio\crudbooster\controllers;

use CRUDBooster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends CBController
{
    function getIndex()
    {
        $data = [];
        $data['page_title'] = '<strong>Selamat Datang</strong>';

        return view('crudbooster::home', $data);
    }

    public function getLockscreen()
    {

        if (! CRUDBooster::myId()) {
            Session::flush();

            return redirect()->route('getLogin')->with('message', trans('crudbooster.alert_session_expired'));
        }

        Session::put('admin_lock', 1);

        return view('crudbooster::lockscreen');
    }

    public function postUnlockScreen()
    {
        $id = CRUDBooster::myId();
        $password = Request::input('password');
        $users = DB::table(config('crudbooster.USER_TABLE'))->where('id', $id)->first();

        if (\Hash::check($password, $users->password)) {
            Session::put('admin_lock', 0);

            return redirect(CRUDBooster::adminPath());
        } else {
            echo "<script>alert('".trans('crudbooster.alert_password_wrong')."');history.go(-1);</script>";
        }
    }

    public function getLogin()
    {

        if (CRUDBooster::myId()) {
            return redirect(CRUDBooster::adminPath());
        }

        return view('crudbooster::login');
    }

    public function postLogin()
    {

        $validator = Validator::make(Request::all(), [
            'username' => 'required|alpha_dash|exists:'.config('crudbooster.USER_TABLE'),
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->all();
            //dd($message);
            return redirect()->back()->with(['message' => /* implode(', ', $message) */'Terjadi kesalahan, silahkan diulang lagi.', 'message_type' => 'danger']);
        }

        $username = Request::input("username");
        $password = Request::input("password");
        $users = DB::table(config('crudbooster.USER_TABLE'))->where("username", $username)->first();
        $tohashid = $users->id.Request::server('REMOTE_ADDR').$users->name;
        $session_id = \Hash::make($tohashid);
        $ip_address_login = Request::server('REMOTE_ADDR');
        $last_session_id = $users->session_id;

        if (\Hash::check($password, $users->password) && (\Hash::check($tohashid, $last_session_id) || $last_session_id == '')) {
            $priv = DB::table("cms_privileges")->where("id", $users->id_cms_privileges)->first();

            $unit = DB::table('t_ref_unit')->where('id',$users->id_kode_unit)->first();

            $roles = DB::table('cms_privileges_roles')->where('id_cms_privileges', $users->id_cms_privileges)->join('cms_moduls', 'cms_moduls.id', '=', 'id_cms_moduls')->select('cms_moduls.name', 'cms_moduls.path', 'is_visible', 'is_create', 'is_read', 'is_edit', 'is_delete')->get();

            $photo = ($users->photo) ? asset($users->photo) : asset('vendor/crudbooster/avatar.jpg');
            Session::put('admin_id', $users->id);
            Session::put('admin_is_superadmin', $priv->is_superadmin);
            Session::put('admin_name', $users->name);
            Session::put('admin_unit', $unit->unit);
            Session::put('admin_unit_id', $unit->id);
            Session::put('admin_photo', $photo);
            Session::put('admin_privileges_roles', $roles);
            Session::put("admin_privileges", $users->id_cms_privileges);
            Session::put('admin_privileges_name', $priv->name);
            Session::put('admin_lock', 0);
            Session::put('theme_color', $priv->theme_color);
            Session::put("appname", CRUDBooster::getSetting('appname'));

            CRUDBooster::insertLog(trans("crudbooster.log_login", ['email' => $users->email, 'ip' => Request::server('REMOTE_ADDR')]));

            DB::table(config('crudbooster.USER_TABLE'))->where('id',$users->id)->update(['session_id'=>$session_id,'ip_address_login'=>$ip_address_login]);
           
            //dd($session_id,$ip_address_login,$users);

            $cb_hook_session = new \App\Http\Controllers\CBHook;
            $cb_hook_session->afterLogin();

            return redirect(/* CRUDBooster::adminPath() */)->route('home');
        } else if(\Hash::check($password, $users->password) && !\Hash::check($tohashid, $last_session_id)){
            return redirect()->route('getLogin')->with('message', 'Anda sedang login di IP:'.$users->ip_address_login.', silahkan logout terlebih dahulu atau hubungi Administrator Itjen Kemenkeu.');
        } else {
            return redirect()->route('getLogin')->with('message', 'Terjadi kesalahan, silahkan diulang lagi.');
        }
    }

    public function getForgot()
    {
        if (CRUDBooster::myId()) {
            return redirect(CRUDBooster::adminPath());
        }

        return view('crudbooster::forgot');
    }

    public function postForgot()
    {
        $validator = Validator::make(Request::all(), [
            'username' => 'required|username|exists:'.config('crudbooster.USER_TABLE'),
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->all();

            return redirect()->back()->with(['message' => implode(', ', $message), 'message_type' => 'danger']);
        }

        $rand_string = str_random(5);
        $password = \Hash::make($rand_string);

        DB::table(config('crudbooster.USER_TABLE'))->where('username', Request::input('username'))->update(['password' => $password]);

        $appname = CRUDBooster::getSetting('appname');
        $user = CRUDBooster::first(config('crudbooster.USER_TABLE'), ['email' => g('email')]);
        $user->password = $rand_string;
        CRUDBooster::sendEmail(['to' => $user->email, 'data' => $user, 'template' => 'forgot_password_backend']);

        CRUDBooster::insertLog(trans("crudbooster.log_forgot", ['email' => g('email'), 'ip' => Request::server('REMOTE_ADDR')]));

        return redirect()->route('getLogin')->with('message', trans("crudbooster.message_forgot_password"));
    }

    public function getLogout()
    {

        $me = CRUDBooster::me();
        DB::table(config('crudbooster.USER_TABLE'))->where('id',$me->id)->update(['session_id'=>null,'ip_address_login'=>null]);

        //dd($me);
        CRUDBooster::insertLog(trans("crudbooster.log_logout", ['email' => $me->email]));

        Session::flush();

        return redirect()->route('home')->with('message', trans("crudbooster.message_after_logout"));

        //return redirect()->route('getLogin')->with('message', trans("crudbooster.message_after_logout"));
    }


}
