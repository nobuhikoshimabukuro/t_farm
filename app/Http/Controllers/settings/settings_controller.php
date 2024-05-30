<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Original\common;

use App\Models\staff_m_model;

class settings_controller extends Controller
{

    function login(Request $request)
    {      
        return view('settings/login');
    }


    function login_check(Request $request)
    {

        try {

            $process_title = "settings_controller-login_check";

            $login_id = $request->login_id;            
            
            $password = $request->password;

            $staff_m = staff_m_model::
            where('login_id', '=', $login_id)  
            ->where('password', '=', $password)
            ->get();

            $get_count = count($staff_m);
            
            if($get_count == 0){

                //ログインIDとパスワードで取得できず::NG
                common::session_remove();               
                // 認証失敗
                session()->flash('login_error', '認証失敗');
                return back();

            }elseif($get_count == 1){
                //ログインIDとパスワードで1件のみ取得::OK

                common::session_remove();

                session()->put('staff_id', $staff_m[0]->staff_id);
                session()->put('staff_name', $staff_m[0]->staff_name);
                

                return redirect()->route('settings.menu');

            }elseif($get_count > 1){

                //ログインIDとパスワードで2件以上取得::CriticalError                         
                session()->flash('login_error', 'システム管理者にお問い合わせください');
                return back();       


            }
            
        } catch (Exception $e) {            

            // 認証失敗
            session()->flash('login_error', 'システム管理者にお問い合わせください');
            return back();
            
        }
        
    }


    function menu(Request $request)
    {
        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }
        return view('settings/menu');
    }

    function system_check(Request $request)
    {
        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }
        return view('settings/system_check');
    }

    function logout(Request $request)
    {
        common::session_remove();
        return view('settings/login');
    }

}
