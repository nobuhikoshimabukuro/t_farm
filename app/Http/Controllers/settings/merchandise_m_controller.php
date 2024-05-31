<?php

namespace App\Http\Controllers\settings;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;

use App\Original\common;

use App\Models\question_t_model;
use App\Models\merchandise_m_model;
use App\Models\question_m_model;
use App\Models\merchandise_image_t_model;

class merchandise_m_controller extends Controller
{
    function index(Request $request)
    {

        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }

        $merchandise_m = merchandise_m_model::
        orderBy('merchandise_id', 'asc')
        ->get();

        foreach ($merchandise_m as $info){

            $merchandise_image_t_info = common::get_merchandise_image_t_info($info->merchandise_id , 2);
            $info->merchandise_image_t = $merchandise_image_t_info["merchandise_image_t"];

        }

        return view('settings/merchandise_m/index', compact('merchandise_m'));
    }


    function settings_screen(Request $request)
    {

        if(!common::session_confirmation()){
            return redirect()->route('settings.login');
        }

        $merchandise_id = $request->merchandise_id;

        $merchandise_m = merchandise_m_model::
        where('merchandise_id', $merchandise_id)
        ->first();
    

       //データ未取得
       if(is_null($merchandise_m)){

            //IDが0以外は異常
            if($merchandise_id <> 0){
                return redirect(route('settings.merchandise_m.index'));    
            }
            
            $display_order_max = merchandise_m_model::max('display_order');

            // 新しいモデルオブジェクトを作成
            $merchandise_m = new merchandise_m_model;

            // デフォルト値を設定
            $default_values = [
                
                'merchandise_id' => 0,
                'merchandise_name' => "",
                'merchandise_description' => "",
                'price' => 0,
                'sales_url' => "",
                'used_flg' => 1,
                'sales_flg' => 1,
                'display_order' => $display_order_max + 1,
                
            ];

            // デフォルト値をモデルオブジェクトに代入
            foreach ($default_values as $key => $value) {
                $merchandise_m->$key = $value;
            }

        }

        $merchandise_image_t_info = common::get_merchandise_image_t_info($merchandise_id , 2); 

        $max_count = merchandise_m_model::get()->count();
        $start_number = 1;
        $end_number = $max_count + 1;
        $numbers = common::create_numbers($start_number, $end_number);

        return view('settings/merchandise_m/settings_screen', compact('merchandise_m','numbers','merchandise_image_t_info'));
        
    }

    function save(Request $request)
    {

        try {

            $table = merchandise_m_model::find($request->merchandise_id);

            $staff_id = session()->get('staff_id');

            if(empty($table)){

                $table = new merchandise_m_model;
                $table->created_by = $staff_id;            
                $table->created_at = now();

            }

            // 画面入力値をセット
            $table->merchandise_name = $request->merchandise_name;
            $table->merchandise_description = $request->merchandise_description;
            $table->price = $request->price === null ? 0 : str_replace(',', '', $request->price);
            $table->sales_url = $request->sales_url;

            $table->sales_flg = $request->sales_flg === null ? 0 : $request->sales_flg;
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

    function image_upload(Request $request)
    {

        try{

            $process_index = 1;
    
            $judge = true;

            $merchandise_id = $request->merchandise_id;            

            $branch_number = is_null($request->branch_number) ? 0 : $request->branch_number;

            $process_branch = $request->process_branch;

            $image_change_flg = $request->image_change_flg;           

            
            //フォルダ名生成
            if($branch_number == 0){

                $process_index = 2;
                
                //新規登録                
                $branch_number = merchandise_image_t_model::withTrashed()->where('merchandise_id', $merchandise_id)->max('branch_number');
                $branch_number = is_null($branch_number) ? 1 : $branch_number + 1; // nullチェック

                while (true) {               

                    $folder_name = $branch_number . common::create_folder_name(4);                
                    // フォルダが存在しない場合
                    if (!Storage::disk('merchandise_image_public_path')->exists("merchandise_id_" . $merchandise_id . "/" . $folder_name)) {
                        // フォルダが存在しないため、ループを抜ける
                        break;
                    }
                }


            }else{

                $process_index = 3;

                //更新処理
                //フォルダ名取得
                $folder_name = merchandise_image_t_model::where('merchandise_id', $merchandise_id)
                ->where('branch_number', $branch_number)
                ->first()
                ->folder_name;                
            }

            

            $path = "merchandise_id_" . $merchandise_id . "/" . $folder_name; 

            $process_index = 4;

            if($process_branch == 0){
            
                $process_index = 5;

                // Path削除処理
                Storage::disk('merchandise_image_public_path')->deleteDirectory($path);

                //データ論理削除
                merchandise_image_t_model::
                where('merchandise_id', $merchandise_id)
                ->where('branch_number', $branch_number)
                ->delete();

            }else{

                $process_index = 6;

                // 新規登録、更新処理
                //画像変更処理が行われた場合のみ行う

                if ($image_change_flg == 1) {

                    $process_index = 7;


                    if ($request->hasFile('merchandise_image_input')) {

                        $process_index = 8;

                        $file = $request->file('merchandise_image_input');
    
                        if ($file) {
                            
                            $process_index = 9;

                            // Path削除処理
                            Storage::disk('merchandise_image_public_path')->deleteDirectory($path);
                            // Path作成処理
                            Storage::disk('merchandise_image_public_path')->makeDirectory($path);     
    
                            $extension = $file->getClientOriginalExtension();
                            $file_name = $file->getClientOriginalName();
                            $file_size = $file->getSize();
        
                            // 画像のリサイズ
                            $resize_img = Image::make($file);
        
                            // 画像の回転を考慮して調整
                            $resize_img->orientate();
        
                            $resize_img->resize(null, 500, function ($constraint) {
                                $constraint->aspectRatio();
                            });
        
                            // リサイズされた画像をエンコードして保存（新しいファイル名を指定）
                            Storage::disk('merchandise_image_public_path')->put($path . '/' . $file_name, $resize_img->encode());

                            $process_index = 10;

                        }else{

                            $process_index = 11;

                            $result_array = array(
                                "result" => "error",
                                "message" => "画像更新処理でエラーが発生しました。【E" .$process_index  . "】",
                            );
        
                            return response()->json(['result_array' => $result_array]);

                        }
    
                    }else{

                        $process_index = 12;

                        $result_array = array(
                            "result" => "error",
                            "message" => "画像更新処理でエラーが発生しました。【E" .$process_index  . "】",
                        );
    
                        return response()->json(['result_array' => $result_array]);


                    }                    
               

                }
                       

                $process_index = 13;

                $staff_id = session()->get('staff_id');                
                
                // merchandise_id と branch_number を使ってレコードを検索
                $table = merchandise_image_t_model::where('merchandise_id', $request->merchandise_id)
                ->where('branch_number', $branch_number)
                ->first();

                $process_index = 14;

                if(empty($table)){

                    $table = new merchandise_image_t_model;
                    $table->created_by = $staff_id;            
                    $table->created_at = now();
                }
                
                $table->merchandise_id = $merchandise_id;
                $table->branch_number = $branch_number;

                
                $table->title = is_null($request->title) ? "未設定" : $request->title;                    
                $table->folder_name = $folder_name;
                $table->used_flg = $request->used_flg;
                $table->display_order = $request->display_order;
                                
                // 更新情報を設定
                $table->updated_by = $staff_id;
                $table->updated_at = now();

                // テーブルを保存
                $table->save();       
                
                $process_index = 15;
            }
         
            //処理成功時は再度画像データ情報を取得
            $merchandise_image_t_info = common::get_merchandise_image_t_info($merchandise_id , 2); 

            $result_array = array(
                "result" => "success",
                "message" => $process_index,
                "merchandise_image_t_info" => $merchandise_image_t_info,
            );


        } catch (Exception $e) {

            $error_message = $e->getMessage();
            $result_array = array(
                "result" => "error",
                "message" => "画像更新処理でエラーが発生しました。【" . $error_message . "】",
            );
        }
    
        return response()->json(['result_array' => $result_array]);

    }



}
