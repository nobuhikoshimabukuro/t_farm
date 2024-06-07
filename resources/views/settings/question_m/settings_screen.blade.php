@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', 'Q&A設定')  

@endsection
@section('content')

<style>

</style>

<div id="main" class="mt-3 text-center container">

    <form action="{{ route('settings.question_m.save') }}" id='save-form'method="post" enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="question_id" id="question_id" value="{{$question_m->question_id}}">

        <div class="row  justify-content-center m-1 p-1">

            <div class="col-xl-7 col-lg-7 col-md-8 col-11">                

                <div class="row m-0 p-0">

                    <table class="w-100 mb-2">
                        <tr>
                            <td class="text-start">
                                <p class="screen-title">
                                    Q&A登録
                                </p>
                            </td>

                            <td class="text-end">

                                <button type="button" id="" 
                                class="btn btn-outline-secondary page-back-button"
                                data-processbranch="1"
                                data-url="{{ route('settings.question_m.index') }}"
                                >一覧に戻る</button>
                            </td>
                        </tr>

                    </table>


                    <div class="col-12 mb-1 p-1 text-end">                        
                        <button type="button" id="clear-button" class="btn btn-secondary">クリア</button>
                        <button type="button" id="save-button" class="btn btn-primary">登録</button>
                    </div>

                    <table class="input-table">

                        <tr>
                            <th>
                                <label for="title"  class="col-form-label">Question</label>
                            </th>

                            <td>
                                <textarea id="question" name="question" class="form-control col-md-3" rows="5" cols="40">{!!$question_m->question!!}</textarea>                 
                            </td>
                        </tr>


                        <tr>
                            <th>
                                <label for="title"  class="col-form-label">Answer</label>
                            </th>

                            <td>
                                <textarea id="answer" name="answer" class="form-control col-md-3" rows="5" cols="40">{!!$question_m->answer!!}</textarea>                 
                            </td>
                        </tr>
                        
                        <tr>                            
                            <th>
                                <label for="title"  class="col-form-label">表示関連</label>
                            </th>

                            <td>

                                <div class="m-0 p-0">

                                    <div class="row m-0 p-0">    
                                        
                                        <div class="col-6 m-0 p-0 text-start d-flex">

                                            <div id="" class="used_flg-area" data-target="1">
                                                <label id="used_flg_1-label" class="used_flg-label">表　示
                                                </label>                                                                              
                                            </div>

                                            <div id="" class="used_flg-area" data-target="0">
                                                <label id="used_flg_0-label" class="used_flg-label">非表示                                                                                   
                                                </label>
                                            </div>                                            
    
                                            <input type="hidden" id="used_flg" name="used_flg" value="{{$question_m->used_flg}}">                                            
                                        </div>


                                        <div id="display_order-area" class="col-6 m-0 p-0 d-flex">                                            
                                                
                                            <label for="display_order"  class="col-form-label align-items-center d-flex me-2">表示順</label>
                                            <select id='display_order' name='display_order' class='form-control display_order-select'>
                                                @foreach($numbers as $number)
                                                    <option value="{{$number}}"
                                                    @if($number == $question_m->display_order)
                                                        selected                                                        
                                                    @endif
                                                    >
                                                        {{$number}}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </td>

                        </tr>                        
                    </table>
            
                </div>

            </div>

        </div>

    </form>
    
</div>


{{-- メッセージモーダルの読み込み --}}
@include('settings/common/message_modal')

{{-- エラーメッセージモーダルの読み込み --}}
@include('settings/common/error_message_modal')




@endsection

@section('pagejs')

<script type="text/javascript">

    $(document).ready(function(){
        change_screen();

        set_used_flg($("#used_flg").val());
    });

    // 画面幅が変更されたときに実行させたい処理内容
    $(window).resize(function(){                 
        change_screen();
    });


    

    function change_screen(){
         // ページの幅を取得
         var screenWidth = window.innerWidth;
        // スマホサイズ（幅が768px以下）の場合
        if (screenWidth <= 768) {
            // rowsの値を適切な値に変更
            document.getElementById("question").rows = 10;
            document.getElementById("answer").rows = 10;
        }else{
            document.getElementById("question").rows = 5;
            document.getElementById("answer").rows = 5;

        }    
    }
    

    $(document).on("click", ".used_flg-area", function (e) {     

        var target = $(this).data('target');

        var used_flg = $("#used_flg").val();

        if(target == used_flg){
            return false;
        }  

        set_used_flg(target);
    });




    

    // 登録ボタンがクリックされたら
    $('#save-button').click(function(){
    
        // ２重送信防止
        // 保存tを押したらdisabled, 10秒後にenable
        $(this).prop("disabled", true);

        setTimeout(function () {
            $('#save-button').prop("disabled", false);
        }, 3000);

        //{{-- メッセージクリア --}}        
        $('.invalid-feedback').html('');
        $('.is-invalid').removeClass('is-invalid');

        let f = $('#save-form');

        //マウスカーソルを砂時計に
        document.body.style.cursor = 'wait';

        start_processing("#main");

        $.ajax({
            url: f.prop('action'), // 送信先
            type: f.prop('method'),
            dataType: 'json',
            data: f.serialize(),
        })
            // 送信成功
            .done(function (data, textStatus, jqXHR) {
                
                end_processing();

                var result_array = data.result_array;

                var result = result_array["result"];

                if(result=='success'){

                    var url = "{{ route('settings.question_m.index') }}";
                    window.location.href = url; 

                }else{

                                 
                    //{{-- ボタン有効 --}}
                    $('#save-button').prop("disabled", false);
                    //{{-- マウスカーソルを通常に --}}                    
                    document.body.style.cursor = 'auto';

                    var message = result_array["message"];

                    //{{-- エラーメッセージ表示 --}}
                    var error_list = '';
                    error_list += '<li>' + message + '</li>';                     
                        
                    error_message_modal_show(error_list);
                    
                }            
            })
            // 送信失敗
            .fail(function (data, textStatus, errorThrown) {
            
                end_processing();
            
                //{{-- ボタン有効 --}}
                $('#save-button').prop("disabled", false);
                //{{-- マウスカーソルを通常に --}}                    
                document.body.style.cursor = 'auto';

                //{{-- エラーメッセージ表示 --}}
                var error_list = '';
                error_list += '<li>データ登録処理でエラーが発生しました</li>';                    
                error_message_modal_show(error_list);


            });
    });
</script>


@endsection

