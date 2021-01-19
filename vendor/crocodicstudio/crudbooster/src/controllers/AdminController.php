<?php namespace crocodicstudio\crudbooster\controllers;

use CRUDBooster;
use DOMDocument;
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
        $rand_num = 290288;
        $tohashid = $users->id.Request::server('REMOTE_ADDR').($users->id+$rand_num);
        $session_id = \Hash::make($tohashid);
        $ip_address_login = Request::server('REMOTE_ADDR');
        $last_session_id = $users->session_id;

        if (\Hash::check($password, $users->password) && (\Hash::check($tohashid, $last_session_id) || $last_session_id == '')) {
            if($users->token_reset){
                DB::table(config('crudbooster.USER_TABLE'))->where('id', $users->id)->update(['token_reset' => NULL]);
            }
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
            Session::put('username',$username);
            Session::put('ajaib',$password);

            CRUDBooster::insertLog(trans("crudbooster.log_login", ['email' => $users->email, 'ip' => Request::server('REMOTE_ADDR')]));

            DB::table(config('crudbooster.USER_TABLE'))->where('id',$users->id)->update(['session_id'=>$session_id,'ip_address_login'=>$ip_address_login]);

            //dd($session_id,$ip_address_login,$users);
            //lhcsend
            
            
            $url = "http://localhost:8080/index.php/site_admin/user/login";
            $cookie= "kukiku.txt";
            $ch = curl_init();
          
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/'.$cookie);
            curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/'.$cookie);
          
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if (curl_errno($ch)) die(curl_error($ch));
          
            $doc = new DOMDocument();
            $doc->loadHTML($response);
            $token = $doc->getElementById("csfr_token")->attributes->getNamedItem("value")->value;
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($ch, CURLOPT_POST, true);
          
            $params = array(
              'Username' => $username,
              'Password' => $password,
              'csfr_token' => $token,
              'Login'=>'Masuk'
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            
            
            curl_exec($ch);
            
          
            if (curl_errno($ch)) print curl_error($ch);
            curl_close($ch);
            
            

            $cb_hook_session = new \App\Http\Controllers\CBHook;
            $cb_hook_session->afterLogin();
            //closing the connection
            
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
            'email' => 'required|email|exists:'.config('crudbooster.USER_TABLE'),
            'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->all();

            return redirect()->back()->with(['message' => implode(', ', $message), 'message_type' => 'danger']);
        }

        $rand_string = str_random(10);
        $password = \Hash::make($rand_string);

        DB::table(config('crudbooster.USER_TABLE'))->where('email', Request::input('email'))->update(['token_reset' => $password]);

        $appname = CRUDBooster::getSetting('appname');
        $user = CRUDBooster::first(config('crudbooster.USER_TABLE'), ['email' => g('email')]);
        $user->link = CRUDBooster::adminPath()."/resetPassword"."/".$user->email."/".$rand_string."/";
        if(!$user->session_id){
            CRUDBooster::sendEmail(['to' => $user->email, 'data' => $user, 'template' => 'forgot_password_backend']);

            CRUDBooster::insertLog(trans("crudbooster.log_forgot", ['email' => g('email'), 'ip' => Request::server('REMOTE_ADDR')]));

            return redirect()->route('getLogin')->with(['message'=> trans("crudbooster.message_forgot_password"),'message_type' => 'success']);
        }else{
            return redirect()->back()->with(['message' => 'Anda masih login di tempat lain, tidak diizinkan reset password.', 'message_type' => 'danger']);
        }

    }

    public function getResetPass($email = null,$token = null){

        $data['token'] = $token;
        $data['email'] = $email;

        return view('crudbooster::resetpass',$data);
    }

    public function postResetPass(){

        $validator = Validator::make(Request::all(), [
            'password' => 'confirmed|min:8|required',
            'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->all();

            return redirect()->back()->with(['message' => implode(', ', $message), 'message_type' => 'danger']);
        }

        $token = Request::input("token_reset");
        $email = Request::input("email");
        $password = Request::input("password");
        $users = DB::table(config('crudbooster.USER_TABLE'))->where("email", $email)->first();


        if ($token && $email == $users->email && \Hash::check($token, $users->token_reset) && !$users->session_id){
            DB::table(config('crudbooster.USER_TABLE'))->where('id', $users->id)->update(['token_reset' => NULL,'password' => \Hash::make($password)]);
            CRUDBooster::insertLog("Seseorang dengan email berikut telah berhasil melakukan reset password", ['email' => g('email'), 'ip' => Request::server('REMOTE_ADDR')]);

            return redirect()->route('getLogin')->with(['message' => 'Silahkan login dengan password baru Anda!', 'message_type' => 'success']);
        }else if($users->session_id){
            DB::table(config('crudbooster.USER_TABLE'))->where('id', $users->id)->update(['token_reset' => NULL]);
            return redirect()->route('getLogin')->with(['message' => 'Anda masih login di tempat lain, reset password dibatalkan!', 'message_type' => 'danger']);
        }else{
            return redirect()->route('getLogin')->with(['message' => 'Maaf, link reset password tidak berlaku!', 'message_type' => 'warning']);
        }


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

    function getCSFRToken() {

        if (!isset($_SESSION['lhc_csfr_token'])){
            $_SESSION['lhc_csfr_token'] = md5(rand(0, 99999999).time().$this->userid);
        }

        return $_SESSION['lhc_csfr_token'];
    }
}
