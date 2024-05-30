@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', 'test')  

@endsection
@section('content')

<style>



body{
    overflow-y: scroll;
}



.image_area{       
    padding: 3px;
}

#upload_area{        
    margin-top: 1vh;
    margin-bottom: 1vh;
}



.reset_button_area{
    margin-top: 1vh;
    margin-bottom: 1vh;
}

.image{       
    width: 100%;
}

#drop_zone{        
    padding: 20px;
    border: 1px solid; 
}



.merchandise-image{        
        width: 100%;    
        height:  100%;
        object-fit: contain; 
    }

</style>

<div id="main" class="mt-3 text-center container">

    <div class="contents row p-0">

        <div class="col-12 m-0 p-0">


            <div class="row">

                @foreach($merchandise_image_infos as $merchandise_image_info)

                    <div class="col-4">
                        <img class="merchandise-image"
                            src="{{$merchandise_image_info["asset_path"]}}"  
                            alt="{{$merchandise_m->merchandise_name}}">
                    </div>

                @endforeach

            </div>

            <form action="{{ route('settings.merchandise_m.save') }}" id='save_form'method="post" enctype="multipart/form-data">
                @csrf

                <button type="button" class="save_button btn btn-primary">登録</button>
                <div class="row">   
                
                    <div id="upload_area">                    
                                
                        <div id="drop_zone">               
                            {{-- @if($termina_info['pc_flg'] == 1)    --}}
                                <p>ファイルをドラッグ＆ドロップもしくはファイル選択してください。</p>
                                <p>※複数アップロードする場合は一度に選択してください。</p>      
                            {{-- @else --}}

                                {{-- <p>※複数アップロードする場合は<br>一度に選択してください。</p> --}}
                            {{-- @endif --}}                                                               
                            <input type="file" id="file_input" name="file[]" lang="ja" accept="image/jpeg, image/png" multiple>



                            <div class="reset_button_area d-none">
                                <div align="left">                        
                                    <button type="button" class="reset_button btn btn-secondary">リセット <i class="fas fa-minus-square"></i></button>                                
                                </div>
                            </div>
    
                                    
    
                            {{-- 画像を追加したらここにプレビュー画像が追加される↓ --}}
                            <div id="preview_area" class="row">
                            </div>
                                
                            <div class="reset_button_area d-none">
                                <div align="right">                        
                                    <button type="button" class="reset_button btn btn-secondary">リセット <i class="fas fa-minus-square"></i></button>
                                </div>
                            </div>

                            

                            <div>
                                
                                <label for="">
                                    表示順
                                </label>

                                <select name="sex">
                                    <option value="man">男性</option>
                                    <option disabled value="woman">女性</option>
                                </select>
                                    
                            </div>


                        </div>                 

                    </div>

                </div>

            </form>

        </div>

    </div>
    
</div>









@endsection

@section('pagejs')

<script type="text/javascript">



$(function(){


// 画像アップロード処理
var drop_zone = document.getElementById('drop_zone');    
var preview_area = document.getElementById('preview_area');
var fileInput = document.getElementById('file_input');

//FormDataオブジェクトを作成
var formData = new FormData();



drop_zone.addEventListener('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
    this.style.background = '#e1e7f0';
}, false);

drop_zone.addEventListener('dragleave', function(e) {
    e.stopPropagation();
    e.preventDefault();
    this.style.background = '#ffffff';
}, false);

drop_zone.addEventListener('drop', function(e) {
    e.stopPropagation();
    e.preventDefault();
    this.style.background = '#ffffff'; //背景色を白に戻す
    var files = e.dataTransfer.files; //ドロップしたファイルを取得
    fileInput.files = files; //inputのvalueをドラッグしたファイルに置き換える。
}, false);

fileInput.addEventListener('change', function () {

    // プレビュー内で表示している画像を一旦クリア
    $("#preview_area").empty();

    // 選択したファイルの全情報取得
    let element = document.getElementById('file_input');

    // 選択したファイルをファイル名で格納
    let files = element.files;

    // 取得したファイル数分、画像をプレビューさせるメソッドを繰り返し呼び出し
    for (var i = 0; i < files.length; i++) {

        PreviewFile(this.files[i],i,files.length);
        $('.reset_button_area').removeClass('d-none');
    }

});    



//ファイルがドロップされたときに呼ばれる
$('#drop_zone').on('drop', function(ev) {

    // プレビュー内で表示している画像を一旦全削除
    $("#preview_area").empty();

    var files = ev.originalEvent.dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        //FormDataオブジェクトにファイルを追加
        //名前は'document_files[]'
        formData.append('document_files[]', files[i]);

        PreviewFile(files[i],i,files.length);
      
        $('.reset_button_area').removeClass('d-none');
    }
    
});


function PreviewFile(file,i,files_count) {

    // プレビュー画像を追加する要素
    const preview_area = document.getElementById('preview_area');

    // FileReaderオブジェクトを作成
    const reader = new FileReader();

    // URLとして読み込まれたときに実行する処理
    reader.onload = function (e) {

        // URLはevent.target.resultで呼び出せる
        const image_url = e.target.result;

        // img要素を作成
        // ("embed")...jpeg,img,pingは通常表示、PDFファイルはスクロールバー付きで表示
        const img = document.createElement("embed");
        img.setAttribute('class', 'image');

        var preview_image_area_id = "preview_image_area" + i;

        var element ="<div id='"+ preview_image_area_id + "' class='col-6 col-md-4 col-xl-3 p-3 image_area'></div>";           

        
        $('#preview_area').append(element);

        // URLをimg要素にセット
        img.src = image_url;

        const preview_image_area = document.getElementById(preview_image_area_id);


        
        // プレビュー領域にプルダウンを追加
        const selectElement = document.createElement("select");
        selectElement.setAttribute("class", "custom-select");
        
        // プルダウンのオプションを追加
        for (let j = 1; j <= files_count; j++) {
            const option = document.createElement("option");
            option.text = j;
            option.value = j; // オプションの値には1から始まる連番をセット
            selectElement.add(option);
        }

        preview_image_area.appendChild(selectElement);






        // #Previewの中に追加
        preview_image_area.appendChild(img);



        
       
    }

    // ファイルをURLとして読み込む
    reader.readAsDataURL(file);
}


    // リセットボタン押下イベント
    $('.reset_button').on('click', function() {
        //{{-- メッセージクリア --}}
        $('.ajax-msg').html('');	

        // プレビュー内で表示している画像を一旦全削除
        $("#preview_area").empty();
        $('.reset_button_area').addClass('d-none');
        $('.reset_button').blur();
        
        
        document.getElementById('file_input').value = '';
        
    });

    const selectedFiles = [];
    $('#file_input').on('change', function(event) {
        selectedFiles.push(event.target.files)
    })


    // save_button押下時
    $('.save_button').on("click", function () {

    
        let f = $('#save_form');

        var formData = new FormData($('#save_form').get(0));

        $.ajax({		
            url: f.prop('action'), //送信先
            type: f.prop('method'),
            dataType: 'json',
            processData: false,
            method: 'post',
            contentType: false,
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            
        })
            .done(function (data, textStatus, jqXHR) {
            

                var result_array = data.result_array;

                var Result = result_array["Result"];


                if(Result == 'success'){

                    location.reload();                                    

                }else{

                    massage = "アップロード処理でエラーが発生しました。";
                    var errorsHtml = '<div class="alert alert-danger text-start">';
                    errorsHtml += '<li>' + massage + '</li>';                    
                    errorsHtml += '</div>';

                    //{{-- アラート --}}    
                    $('.ajax-msg').html(errorsHtml);

                }
            
            })
                .fail(function (data, textStatus, errorThrown) {

                    

                    

                    massage = "アップロード処理でエラーが発生しました。";
                    var errorsHtml = '<div class="alert alert-danger text-start">';
                    errorsHtml += '<li>' + massage + '</li>';                    
                    errorsHtml += '</div>';

                    //{{-- アラート --}}    
                    $('.ajax-msg').html(errorsHtml);

                    //マウスカーソルを通常に
                    document.body.style.cursor = 'auto';
                    //{{-- ボタン有効 --}}
                    $('.save_button').prop("disabled", false);

                    //{{-- 画面上部へ --}}
                    $("html,body").animate({
                        scrollTop: 0
                    }, "300");
                
                });
            });







});




</script>


@endsection

