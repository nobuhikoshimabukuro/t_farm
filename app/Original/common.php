<?php

namespace App\Original;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;
use App\Models\staff_m_model;
use App\Models\address_m_model;

use Illuminate\Http\Request;

use Jenssegers\Agent\Agent;



use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;



use App\Models\question_t_model;
use App\Models\merchandise_m_model;
use App\Models\question_m_model;
use App\Models\merchandise_image_t_model;


class common
{   
    
    //管理側session確認処理
    public static function session_confirmation()
    {
        //返却用変数、初期値はfalse
        $Judge = false;

        // 指定キーがセッションに存在するかを調べる
        if ((session()->exists('staff_id'))) {

            $staff_id = session()->get('staff_id');
            $staff_name = session()->get('staff_name');            

            //どちらかがnullの場合はNG
            if (is_null($staff_id ) || is_null($staff_name)) {                
                $Judge = false;
            }else{
                //改めてセッションに格納
                session()->put('staff_id', $staff_id);
                session()->put('staff_name', $staff_name);
                $Judge = true;
            }
        }

        return $Judge;
    }

    //管理側ログイン情報を破棄
    public static function session_remove() {

        session()->remove('staff_id');
        session()->remove('staff_name');        
        return true;
    }
    
    public static function create_numbers($start_number , $end_number) {

        $return_array = [];

        for ($i = $start_number; $i <= $end_number; $i++) {
            $return_array []= $i;
        }
      
        return $return_array;
    }

    public static function get_merchandise_image_t_info($merchandise_id , $process_branch) {

        try{            

            $merchandise_image_t_info = [];
            $merchandise_base_path = "public/merchandise_image/merchandise_id_" . $merchandise_id;

            $merchandise_image_t = merchandise_image_t_model::
            where('merchandise_id', $merchandise_id)
            ->orderBy('display_order', 'asc');
            

            if($process_branch == 1){
                $merchandise_image_t = $merchandise_image_t->where('used_flg', 1);
            }
            

            $merchandise_image_t = $merchandise_image_t
            ->orderBy('display_order', 'asc')
            ->get();

            foreach ($merchandise_image_t as $index => $info){

                $folder_name = $info->folder_name;
              
                $path = $merchandise_base_path . "/" . $folder_name;

                $files = Storage::files($path);

                $image_name = "";
                $asset_path = "";
                $storage_path = "";                    
                
                //画像があるかチェック
                if(count($files) > 0){

                    $merchandise_folder_path = "merchandise_image/merchandise_id_" . $merchandise_id . "/" . $folder_name . "/";

                    $base_asset_path = "storage/" . $merchandise_folder_path;
                    $base_storage_path = "app/public" . $merchandise_folder_path;

                    $file = $files[0];

                    $image_info = pathinfo($file);                        
                    $image_name = $image_info['basename'];

                    $image_name = $image_name;
                    $asset_path = asset($base_asset_path . $image_name);
                    $storage_path = storage_path($base_storage_path. $image_name);                    
                }

                $info->image_name = $image_name;
                $info->asset_path = $asset_path;
                $info->storage_path = $storage_path;              


            }

            $merchandise_image_t_info["merchandise_image_t"] = $merchandise_image_t;

            $max_count = merchandise_image_t_model::where('merchandise_id', $merchandise_id)->get()->count();            
            $merchandise_image_t_info["max_count"] = $max_count + 1;

        } catch (Exception $e) {

            $merchandise_image_t_info["merchandise_image_t"] = [];
            $merchandise_image_t_info["max_count"] = 20;

        }


        return $merchandise_image_t_info;

    }


    public static function create_folder_name($length)
    {
        $folder_name = "";

        // $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $chars = 'abcdefhkmnpqrstuvwxyzAEFHJKLMNPRSTUVWXY345679';

        $count = mb_strlen($chars);
     
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $folder_name .= mb_substr($chars, $index, 1);
        }        

        return $folder_name;
    }

}

