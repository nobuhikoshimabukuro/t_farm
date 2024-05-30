@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', 'インスタグラム投稿一覧')

@endsection
@section('content')

<style>


</style>

<div id="main" class="mt-3 text-center container">

    <div class="row m-0 p-0">

        <div class="col-12">
        
            <div class="row mt-1 p-0">
                <div class="col-6 text-start">                    
                    <button type='button' class='btn btn-outline-primary page-transition-button' data-url="{{ route('web.index')}}">Webページ</button>
                </div>
                <div class="col-6 text-end">                    
                    <button class='btn btn-success' type='button' onclick= "location.href='{{ route('settings.instagram_t.settings_screen' ,['instagram_id' =>0]) }}'">新規登録</button>
                </div>
            </div>

            <div id="data-display-area" class="m-0">            
            
                
                <table id='' class='data-info-table'>
                    @php
                        $text_class_kinds = ["text-start" , "text-center" , "text-end"];

                        $text_class = [];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[0];
                        $text_class []= $text_class_kinds[0];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[0];
                        $text_class []= $text_class_kinds[1];
                        $text_class_index = 0;
                    @endphp
                    <tr>
                        <th class="{{$text_class[$text_class_index++]}}">ID</th>
                        <th class="{{$text_class[$text_class_index++]}}">タイトル</th>
                        <th class="{{$text_class[$text_class_index++]}}">表示状態</th>
                        <th class="{{$text_class[$text_class_index++]}}">並び順</th>
                        <th class="{{$text_class[$text_class_index++]}}">投稿内容</th>                    
                        <th class="{{$text_class[$text_class_index++]}}"></th>
                        
                    </tr>

                    @foreach ($instagram_t as $item)

                        @php                    
                            $text_class_index = 0;
                        @endphp
                        <tr>
                            <td class="{{$text_class[$text_class_index++]}}">{{$item->instagram_id}}</td>
                            <td class="{{$text_class[$text_class_index++]}}">{{$item->title}}</td>
                            <td class="{{$text_class[$text_class_index++]}}">
                                <div class="d-flex">
                                    @if($item->used_flg == 1)

                                        <div class="eye-area d-flex">
                                            <i class="far fa-eye"></i>
                                            <i class="far fa-eye"></i>
                                        </div>
                                        <span>表示中</span>                                        
                                    @else
                                        <div class="eye-area d-flex">
                                            <i class="far fa-eye-slash"></i>
                                            <i class="far fa-eye-slash"></i>
                                        </div>
                                        <span>非表示</span>
                                        
                                    @endif            
                                </div>                
                            </td>
                            <td class="{{$text_class[$text_class_index++]}}">{{$item->display_order}}</td>
                            <td class="{{$text_class[$text_class_index++]}}">
                                <button type="button" id="" class="btn btn-outline-primary instagram-load-button"
                                    data-embeddedcharacters='{!!$item->embedded_characters!!}'
                                    >
                                    確認
                                </button>
                            </td>

                            <td class="{{$text_class[$text_class_index++]}}">
                                <button class='btn btn-outline-success' type='button' onclick= "location.href='{{ route('settings.instagram_t.settings_screen' ,['instagram_id' =>$item->instagram_id]) }}'">修正</button>
                            </td>
                        
                        </tr>

                    @endforeach

                    <input type="hidden" name="embedded_characters" id="embedded_characters" value="">

                </table>

            </div>

        </div>      

    </div>
    
</div>




    
   
{{-- インスタグラム確認用モーダルの読み込み --}}
@include('settings/instagram_t/instagram_modal')






@endsection

@section('pagejs')

<script type="text/javascript">

   

$(document).on("click", ".instagram-load-button", function (e) {

    var embedded_characters = $(this).data('embeddedcharacters');
    $('#embedded_characters').val(embedded_characters);

  
    // モーダルを表示する
    $("#instagram-modal").modal('show');
});



//インスタグラム確認モーダルを開いた時のイベント
$('#instagram-modal').on('show.bs.modal', function(e) {        
        
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
$('#instagram-modal').on('hidden.bs.modal', function() {

    $('#embedded_characters').val("");
    $('#instagram-modal-iframe').attr('src', "");

    // モーダルが閉じられた後にディレイを設定して縦スクロールを有効に
    setTimeout(function() {
        $('body').css('overflow-y', 'auto');
    }, 500); // 500ミリ秒のディレイ
})

</script>


@endsection

