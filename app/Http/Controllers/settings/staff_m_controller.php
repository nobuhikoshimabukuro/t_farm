<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\instagram_t_model;
use App\Models\merchandise_m_model;
use App\Models\staff_m_model;

class staff_m_controller extends Controller
{
    function index(Request $request)
    {

        $staff_m = staff_m_model::
        orderBy('staff_id', 'asc')
        ->get();


        return view('settings/staff_m/index', compact('staff_m'));
    }

    function settings_screen(Request $request)
    {

        $staff_id = $request->staff_id;

        $staff_m = staff_m_model::
        where('staff_id', $staff_id)
        ->first();

        //データ未取得
        if(is_null($staff_m)){

            //IDが0以外は異常
            if($staff_id <> 0){
                return redirect(route('settings.staff_m.index'));    
            }

   

            // 新しいモデルオブジェクトを作成
            $staff_m = new staff_m_model;

            // デフォルト値を設定
            $default_values = [
                
                'staff_id' => 0,
                'staff_name' => "",
                'login_id' => "",
                'password' => "",                
            ];

            // デフォルト値をモデルオブジェクトに代入
            foreach ($default_values as $key => $value) {
                $staff_m->$key = $value;
            }

        }


        return view('settings/staff_m/settings_screen', compact('staff_m'));
    }
}
