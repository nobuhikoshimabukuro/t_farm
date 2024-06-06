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

use App\Models\question_t_model;
use App\Models\merchandise_m_model;
use App\Models\question_m_model;

class question_m_controller extends Controller
{
    function index(Request $request)
    {

        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }

        $question_m = question_m_model::
        orderBy('question_id', 'asc')
        ->get();


        return view('settings/question_m/index', compact('question_m'));
    }


    function settings_screen(Request $request)
    {

        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }

        $question_id = $request->question_id;

        $question_m = question_m_model::
        where('question_id', $question_id)
        ->first();
    

       //データ未取得
       if(is_null($question_m)){

            //IDが0以外は異常
            if($question_id <> 0){
                return redirect(route('settings.question_m.index'));    
            }
            
            $display_order_max = question_m_model::max('display_order');

            // 新しいモデルオブジェクトを作成
            $question_m = new question_m_model;

            // デフォルト値を設定
            $default_values = [
                
                'question_id' => 0,
                'question' => "",
                'answer' => "",                
                'used_flg' => 0,                
                'display_order' => $display_order_max + 1,
                
            ];

            // デフォルト値をモデルオブジェクトに代入
            foreach ($default_values as $key => $value) {
                $question_m->$key = $value;
            }

        }

        $max_count = question_m_model::get()->count();

        $start_number = 1;
        $end_number = $max_count + 1;
        $numbers = common::create_numbers($start_number, $end_number);

        
        return view('settings/question_m/settings_screen', compact('question_m','numbers'));
    }


    function save(Request $request)
    {

        try {

            $table = question_m_model::find($request->question_id);

            $staff_id = session()->get('staff_id');

            if(empty($table)){

                $table = new question_m_model;
                $table->created_by = $staff_id;            
                $table->created_at = now();

            }

            // 画面入力値をセット
            $table->question = $request->question;
            $table->answer = $request->answer;            
            $table->used_flg = $request->used_flg === null ? 0 : $request->used_flg;
            $table->display_order = $request->display_order;
        
            $table->updated_by = $staff_id;        
            $table->updated_at = now();
            
            // テーブル更新
            $table->save();

            $result_array = array(
                "result" => "success",
                "message" => "",
            );


        } catch (Exception $e) {            

            $error_message = $e->getMessage();
            $result_array = array(
                "result" => "error",
                "message" => "登録処理でエラーが発生しました。",
            );

        }

        return response()->json(['result_array' => $result_array]);

    }

    function delete(Request $request)
    {

        try {

            $table = question_m_model::find($request->question_id);

            $staff_id = session()->get('staff_id');

            if(empty($table)){

                $result_array = array(
                    "result" => "error",
                    "message" => "削除するデータが存在しません。",
                );

            }else{

                $table->deleted_by = $staff_id;        
                $table->deleted_at = now();
                
                // テーブル更新
                $table->save();
    
                $result_array = array(
                    "result" => "success",
                    "message" => "",
                );

            }


        } catch (Exception $e) {            

            $error_message = $e->getMessage();
            $result_array = array(
                "result" => "error",
                "message" => "削除処理でエラーが発生しました。",
            );
        }

        return response()->json(['result_array' => $result_array]);

    }

}
