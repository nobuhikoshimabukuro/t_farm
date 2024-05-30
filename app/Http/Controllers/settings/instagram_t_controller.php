<?php

namespace App\Http\Controllers\settings;


use App\Http\Controllers\Controller;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Original\common;

use App\Models\instagram_t_model;
use App\Models\merchandise_m_model;

class instagram_t_controller extends Controller
{
    function index(Request $request)
    {

        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }

        $instagram_t = instagram_t_model::
        orderBy('instagram_id', 'asc')
        ->get();

        


        return view('settings/instagram_t/index', compact('instagram_t'));
    }


    function settings_screen(Request $request)
    {

        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }

        $instagram_id = $request->instagram_id;

        $instagram_t = instagram_t_model::
        where('instagram_id', $instagram_id)
        ->first();

        //データ未取得
        if(is_null($instagram_t)){

            //IDが0以外は異常
            if($instagram_id <> 0){
                return redirect(route('settings.instagram_t.index'));    
            }

            $display_order_max = instagram_t_model::max('display_order');

            // 新しいモデルオブジェクトを作成
            $instagram_t = new instagram_t_model;

            // デフォルト値を設定
            $default_values = [
                
                'instagram_id' => 0,
                'title' => "",
                'embedded_characters' => "",
                'used_flg' => 0,
                'display_order' => $display_order_max + 1,
                
            ];

            // デフォルト値をモデルオブジェクトに代入
            foreach ($default_values as $key => $value) {
                $instagram_t->$key = $value;
            }

        }

        $max_count = instagram_t_model::get()->count();
        $start_number = 1;
        $end_number = $max_count + 1;
        $numbers = common::create_numbers($start_number, $end_number);

        return view('settings/instagram_t/settings_screen', compact('instagram_t','numbers' ));
    }


    function instagram_confirmation(Request $request)
    {

        $embedded_characters = $request->embedded_characters;
        return view('settings/instagram_t/instagram_confirmation', compact('embedded_characters'));

    }

    function save(Request $request)
    {

        try {

            $table = instagram_t_model::find($request->instagram_id);

            $staff_id = session()->get('staff_id');

            if(empty($table)){

                $table = new instagram_t_model;
                $table->created_by = $staff_id;            
                $table->created_at = now();

            }

            // 画面入力値をセット
            $table->title = $request->title;
            $table->embedded_characters = $request->embedded_characters;            
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


}
