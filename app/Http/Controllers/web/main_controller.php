<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryMail;
use App\Original\common;

use App\Models\instagram_t_model;
use App\Models\question_t_model;
use App\Models\merchandise_m_model;
use App\Models\question_m_model;

class main_controller extends Controller
{


    function index(Request $request)
    {       
        
        if(!$this->session_confirmation()){
            $desired_url = route('web.index');
            session()->flash('desired_url', $desired_url);
            return redirect()->route('web.password_check');    
        }

        $instagram_t = instagram_t_model::
        where('used_flg', '=', 1)
        ->orderBy('display_order', 'asc')
        ->get();

        return view('web/screen/index', compact('instagram_t'));
     
    }


    function merchandise(Request $request)
    {        
        if(!$this->session_confirmation()){
            $desired_url = route('web.merchandise');
            session()->flash('desired_url', $desired_url);
            return redirect()->route('web.password_check');    
        }
      
        $merchandise_m = merchandise_m_model::
        where('used_flg', '=', 1)
        ->orderBy('display_order', 'asc')
        ->get();

        foreach ($merchandise_m as $info){

            $merchandise_image_t_info = common::get_merchandise_image_t_info($info->merchandise_id , 1);
            $info->merchandise_image_t = $merchandise_image_t_info["merchandise_image_t"];

        }

        

        return view('web/screen/merchandise', compact('merchandise_m'));
    }

    function farminfo(Request $request)
    {        
        if(!$this->session_confirmation()){
            $desired_url = route('web.farminfo');
            session()->flash('desired_url', $desired_url);
            return redirect()->route('web.password_check');    
        }
        return view('web/screen/farminfo');
    }

    function forcorporation(Request $request)
    {        
        if(!$this->session_confirmation()){
            $desired_url = route('web.forcorporation');
            session()->flash('desired_url', $desired_url);
            return redirect()->route('web.password_check');    
        }
        return view('web/screen/forcorporation');
    }

    function inquiry(Request $request)
    {        
        if(!$this->session_confirmation()){
            $desired_url = route('web.inquiry');
            session()->flash('desired_url', $desired_url);
            return redirect()->route('web.password_check');    
        }

        $question_m = question_m_model::
        where('used_flg', '=', 1)
        ->orderBy('display_order', 'asc')
        ->get();

        return view('web/screen/inquiry', compact('question_m'));        
    }


    function password_check(Request $request)
    {        
        return view('web/screen/password_check');
    }

    function password_check_process(Request $request)
    {        
        try {


            $desired_url = $request->desired_url;
            $password = $request->password;
          

            $Today = Carbon::now();
            // $correct_password =  $Today->format('Y') . "t" . $Today->format('md'); 
            $correct_password = $Today->format('md'); 

            if($correct_password == $password){

                session()->put('login_flg', "1");

                if(is_Null($desired_url) || $desired_url == ""){
                    return redirect()->route('web.index');
                }else{
                    return redirect($desired_url); 
                }
                
                

            }else{
                // 認証失敗
                session()->flash('desired_url', $desired_url);
                session()->flash('password_check_nerror', '認証失敗');
                return back();
            }






         

        } catch (Exception $e) {

                
            $ErrorMessage = 'パスワード確認処理エラー';

            $ResultArray = array(
                "Result" => "error",
                "Message" => $ErrorMessage,
            );        

            return response()->json(['ResultArray' => $ResultArray]);

        }
    }

    

    //確認処理        
    function session_confirmation()
    {
        //返却用変数、初期値はfalse
        $Judge = false;

        // 指定キーがセッションに存在するかを調べる
        if ((session()->exists('login_flg'))) {

            $login_flg = session()->get('login_flg');

            //login_flgが'1'はsession確認OK
            if ($login_flg == 1) {
                $Judge = true;
            }
        }

        return $Judge;
    }

    //お問い合わせメール送信
    function send_inquiry_mail_process(Request $request)
    {        

        try {

            $now = Carbon::now();        

            $date_time =  $now->toDateTimeString();

            $inquirer_name = $request->inquirer_name;
            $mailaddress = $request->mailaddress;
            $question = $request->question;        


            // $log_text = "メール送信開始";
            // Log::error($log_text);

            //顧客に返信不要メール送信
            Mail::to($mailaddress)->send(new InquiryMail($inquirer_name , $mailaddress , $question , $date_time, 1));
            //管理者に詳細メール送信
            Mail::to(env('automatic_destination_mailaddress'))->send(new InquiryMail($inquirer_name , $mailaddress , $question , $date_time , 2));

        } catch (Exception $e) {
            
            // $log_text = $e->getMessage();
            // Log::error($log_text);

            $ErrorMessage = 'メール送信処理でエラーが発生しました。';

            $ResultArray = array(
                "Result" => "error",
                "Message" => $ErrorMessage,
            );        

            return response()->json(['ResultArray' => $ResultArray]);

        }


        $ResultArray = array(
            "Result" => "success",
            "Message" => '',
        );

        return response()->json(['ResultArray' => $ResultArray]);

    }
}
