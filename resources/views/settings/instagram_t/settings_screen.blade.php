@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', 'インスタグラム投稿設定')  

@endsection
@section('content')

<style>

</style>

<div id="main" class="mt-3 text-center container">

    <form action="{{ route('settings.instagram_t.save') }}" id='save-form'method="post" enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="instagram_id" id="instagram_id" value="{{$instagram_t->instagram_id}}">

        <div class="row  justify-content-center m-1 p-1">

            <div class="col-xl-7 col-lg-7 col-md-8 col-11">                

                <div class="row m-0 p-0">

                    <table class="w-100 mb-2">
                        <tr>
                            <td class="text-start">
                                <p class="screen-title">
                                    インスタグラム登録
                                </p>
                            </td>

                            <td class="text-end">

                                <button type="button" id="" 
                                class="btn btn-outline-secondary page-back-button"
                                data-processbranch="1"
                                data-url="{{ route('settings.instagram_t.index') }}"
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
                                <label for="title"  class="col-form-label">タイトル</label>
                            </th>

                            <td>
                                <input type="text" name="title" id="title" class="form-control" value="{{$instagram_t->title}}">
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
    
                                            <input type="hidden" id="used_flg" name="used_flg" value="{{$instagram_t->used_flg}}">                                            
                                        </div>


                                        <div id="display_order-area" class="col-6 m-0 p-0 d-flex">                                            
                                                
                                            <label for="display_order"  class="col-form-label align-items-center d-flex me-2">表示順</label>
                                            <select id='display_order' name='display_order' class='form-control display_order-select'>
                                                @foreach($numbers as $number)
                                                    <option value="{{$number}}"
                                                    @if($number == $instagram_t->display_order)
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


                        <tr>
                            <th>
                                <label for="embedded_characters">埋め込み文字</label>
                            </th>

                            <td>

                                <div class="col-12 mb-2 p-0 text-end">
                                    <button type="button" id="" class="btn btn-secondary page-transition-button"　
                                    data-url="{{ env('instagram_url')}}"
                                    >Instagram</button>
    
                                    <button type="button" id="" class="btn btn-secondary page-transition-button"　
                                    data-url="https://embedsocial.jp/blog/how-to-embed-instagram-to-website/"
                                    >参考サイト</button>

                                </div>

                                <textarea id="embedded_characters" name="embedded_characters" class="form-control col-md-3" rows="20" cols="40">{!!$instagram_t->embedded_characters!!}</textarea>                 
                                

                                <div class="col-12 mt-2 p-0 text-end">
                                    <button type="button" id="" class="btn btn-secondary reset-button">リセット</button>
                                    <button type="button" id="" class="btn btn-dark instagram-load-button">埋め込み文字読込</button>
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


{{-- インスタグラム確認用モーダルの読み込み --}}
@include('settings/instagram_t/instagram_modal')


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
            document.getElementById("embedded_characters").rows = 15;
        }else{
            document.getElementById("embedded_characters").rows = 20;

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




    $(document).on("click", ".reset-button", function (e) {

        var message = "埋め込み文字をリセットしても宜しいですか？";    

        if(!confirm(message)){     
            return false;
        }

        $('#embedded_characters').val('');        
    });


    $(document).on("click", ".instagram-load-button", function (e) {

        var embedded_characters = $('#embedded_characters').val();
        
        if(embedded_characters == ""){         
            
            alert("埋め込み文字が未入力です。");
            return false;
        }    

        // モーダルを表示する
        $("#instagram-modal").modal('show');
    });


  
    //インスタグラム確認モーダルを開いた時のイベント
    $('#instagram-modal').on('show.bs.modal', function(e){
        var embedded_characters = $('#embedded_characters').val();        

        // パラメータを含めたURLを作成
        var url = "{{ route('settings.instagram_t.instagram_confirmation') }}?embedded_characters=" + encodeURIComponent(embedded_characters);
        // iframeのsrc属性にURLをセット
        $('#instagram-modal-iframe').attr('src', url);

        // モーダルが表示される前にディレイを設定して縦スクロールを無効に
        setTimeout(function() {
            $('body').css('overflow-y', 'hidden');
        }, 500); // 500ミリ秒のディレイ
    });

    //インスタグラム確認モーダルを閉じた時のイベント
    $('#instagram-modal').on('hidden.bs.modal', function(){

        $('#instagram-modal-iframe').attr('src', "");

         // モーダルが閉じられた後にディレイを設定して縦スクロールを有効に
        setTimeout(function() {
            $('body').css('overflow-y', 'auto');
        }, 500); // 500ミリ秒のディレイ
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

                    var url = "{{ route('settings.instagram_t.index') }}";
                    window.location.href = url; 

                }else{

                                 
                    //{{-- ボタン有効 --}}
                    $('#save-button').prop("disabled", false);
                    //{{-- マウスカーソルを通常に --}}                    
                    document.body.style.cursor = 'auto';

                    var message = result_array["message"];

                    //{{-- アラートメッセージ表示 --}}
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

