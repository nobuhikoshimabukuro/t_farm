@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', '商品登録')  

@endsection
@section('content')

<style>


.merchandise-image-title{    
    text-align: center;    
    font-weight: bold;
    color: rgb(1, 30, 30);
}

.merchandise-image-outer-area{
    width: 100%;
    overflow-x: auto;    
    display: flex;    
    background-color:  rgb(252, 250, 250);
}

.merchandise-image-inner-area{
    min-width: 300px;    
    padding: 3px;
}


.merchandise-image-title{     
    border: 1px solid;
    border-bottom: none;
}
.merchandise-image-area{
    aspect-ratio: 16 / 9;
    padding: 3px;    
    border: 1px solid;
}


.merchandise-image-inner-preview-area{
    width: 300px;    
    padding: 3px;
}

.merchandise-image-preview-area{
    /* aspect-ratio: 16 / 9; */
    padding: 3px;    
    border: 1px solid;
}

.merchandise-image{        
        width: 100%;    
        height:  100%;
        object-fit: contain; 
        
    }

.merchandise-image-opacity{
     opacity: 0.5;
}

#price{
    width: 7rem;
}

.en{
    margin-left: 1rem;
    font-size: 1.1rem;
    font-weight: bold;
}

</style>

<div id="main" class="mt-3 text-center container">
    
    <form action="{{ route('settings.merchandise_m.save') }}" id='save-form'method="post" enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="merchandise_id" id="merchandise_id" value="{{$merchandise_m->merchandise_id}}">

        <div class="row justify-content-center m-1 p-1">

            <div class="col-xl-7 col-lg-8 col-md-9 col-11">

                <div class="row m-0 p-0">

                    <table class="w-100 mb-2">
                        <tr>
                            <td class="text-start">
                                <p class="screen-title">
                                    商品登録
                                </p>
                            </td>

                            <td class="text-end">

                                <button type="button" id="" 
                                class="btn btn-outline-secondary page_transition-button"
                                data-processbranch="1"
                                data-url="{{ route('settings.merchandise_m.index') }}"
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
                                <label for="merchandise_name"  class="col-form-label">商品名</label>
                            </th>

                            <td>
                                <input type="text" name="merchandise_name" id="merchandise_name" class="form-control" value="{{$merchandise_m->merchandise_name}}">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="price"  class="col-form-label">料金</label>
                            </th>

                            <td class="d-flex align-items-center">
                                <input type="text" name="price" id="price" class="form-control text-end numeric" value="{{number_format($merchandise_m->price)}}" maxlength="8">
                                <div class="en">
                                    円
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="merchandise_description"  class="col-form-label">商品紹介</label>
                            </th>

                            <td>
                                <textarea id="merchandise_description" name="merchandise_description" 
                                class="form-control" rows="10">{!!$merchandise_m->merchandise_description!!}
                                {{-- {{$merchandise_m->merchandise_description}} --}}
                            
                                {{-- {!! nl2br($merchandise_m->merchandise_description) !!} --}}
                            </textarea>                                
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="sales_url"  class="col-form-label">販売サイトURL</label>

                                <button type="button" class="btn btn-outline-danger url-confirmation-button">URL確認</button>   
                            </th>

                            <td>
                                <input type="text" name="sales_url" id="sales_url" class="form-control" value="{{$merchandise_m->sales_url}}">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label class="col-form-label">販売状況</label>                               
                            </th>

                            <td class="d-flex">                                
                                <div id="" class="sales_flg-area" data-target="1">
                                    <label id="sales_flg_1-label" class="sales_flg-label">販売中
                                    </label>                                                                              
                                </div>

                                <div id="" class="sales_flg-area" data-target="0">
                                    <label id="sales_flg_0-label" class="sales_flg-label">完　売                                                                                   
                                    </label>
                                </div>                                            

                                <input type="hidden" id="sales_flg" name="sales_flg" value="{{$merchandise_m->sales_flg}}">  
                            </td>
                        </tr>
                        
                        <tr>                            
                            <th>
                                <label class="col-form-label">表示関連</label>
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
    
                                            <input type="hidden" id="used_flg" name="used_flg" value="{{$merchandise_m->used_flg}}">
                                        </div>


                                        <div id="display_order-area" class="col-6 m-0 p-0 d-flex">                                            
                                                
                                            <label for="display_order"  class="col-form-label align-items-center d-flex me-2">表示順</label>
                                            <select id='display_order' name='display_order' class='form-control display_order-select'>
                                                @foreach($numbers as $number)
                                                    <option value="{{$number}}"
                                                    @if($number == $merchandise_m->display_order)
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

            <div class="col-11 mt-2 p-0">
                <h4>
                    画像設定
                </h4>

                <div class="merchandise-image-outer-area">
                    {{-- jQueryで作成 --}}
                    {{-- function set_merchandise_image --}}
                </div>

                <div class="row mt-1 p-0">
                    <div class="col-12 m-0 p-0 text-end">
                        <button type="button" id="" class="btn btn-primary image_upload-modal-button" data-branchnumber="0">画像新規登録</button>
                    </div>
                </div>

            </div>

        </div>

    </form>
    
</div>




 {{-- 画像更新モーダル --}}
 
 <div class="modal fade" id="image_upload-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="image_upload-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <input type="hidden" name="branch_number" id="branch_number" value="0">
            <input type="hidden" name="image_change_flg" id="image_change_flg" value="0">

            <div class="modal-header">               
                <h5 class="modal-title" >商品画像登録</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>                
            <form action="{{ route('settings.merchandise_m.image_upload') }}" id='image_upload-form'method="post" enctype="multipart/form-data">

                <div class="modal-body">


                    <table class="input-table w-100">

                        <tr>
                            <th>
                                <label for="merchandise_image_title"  class="col-form-label">画像タイトル</label>
                            </th>
                        </tr>

                        <tr>                            
                            <td>
                                <input type="text" name="merchandise_image_title" id="merchandise_image_title" class="form-control" value="">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label   class="col-form-label">画像表示設定</label>
                            </th>
                        </tr>

                        <tr>                            
                            <td class="d-flex">

                                <div id="" class="merchandise_image_used_flg-area" data-target="1">
                                    <label id="merchandise_image_used_flg_1-label" class="merchandise_image_used_flg-label">表　示
                                    </label>                                                                              
                                </div>

                                <div id="" class="merchandise_image_used_flg-area" data-target="0">
                                    <label id="merchandise_image_used_flg_0-label" class="merchandise_image_used_flg-label">非表示                                                                                   
                                    </label>
                                </div>         
                                <input type="hidden" id="merchandise_image_used_flg" name="merchandise_image_used_flg" value="">
                               
                            </td>
                        </tr>


                        <tr>
                            <th>
                                <label for="merchandise_image_display_order"  class="col-form-label">画像表示順</label>
                            </th>
                        </tr>

                        <tr>                            
                            <td>
                                <div id="" class="m-0 p-0 d-flex">                                    
                                    <select id='merchandise_image_display_order' name='merchandise_image_display_order' class='form-control display_order-select'>
                                        {{-- jQueryで作成 --}}
                                    </select>
                                </div>
                            </td>
                        </tr>


                        <tr>
                            <th class="text-start">
                                <input type="file" 
                                id='merchandise_image_input'
                                name="merchandise_image_input" 
                                class="d-none"
                                accept=".png , .PNG , .jpg , .JPG , .jpeg , .JPEG">
    
                            <button type="button" id='' class="btn btn-success merchandise-image-input-button" >画像選択</button>    
                            <button type="button" class="reset-button btn btn-secondary">リセット <i class="fas fa-minus-square"></i></button>
                            </th>
                        </tr>

                        <tr>
                            <th class="">

                                <div id="" class="w-100">
                                    <div id="merchandise-image-preview-area" class="merchandise-image-preview-area">                                        
                                    </div>
                                </div>
                                
                            </th>
                        </tr>



                    </table>

                  


                        
                </div>
            </form>

            <div class="modal-footer">         

                

                <div class="col-12 m-0 p-0 text-end">
                    <button type="button" class="btn btn-success image_info_change-button" data-processbranch="1">登録</button>
                    <button type="button" class="btn btn-danger image_info_change-button" data-processbranch="0">削除</button>                    
                    <button type="button" id="" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div>                            
            </div>

        </div>
        
    </div>

</div>

{{-- メッセージモーダルの読み込み --}}
@include('settings/common/message_modal')

{{-- エラーメッセージモーダルの読み込み --}}
@include('settings/common/error_message_modal')

@endsection

@section('pagejs')

<script type="text/javascript">

    //FormDataオブジェクトを作成
    var formData = new FormData();
    
    // 画像アップロード処理関連     
    var merchandise_image_input = document.getElementById('merchandise_image_input');   
    
    var no_image_element = "<img src='{{asset('img/no_image/no_image.jpeg')}}' class='merchandise-image' alt=''> ";

    var merchandise_image_t_max_count = 0;

    $(document).ready(function(){
        change_screen();
        set_used_flg($("#used_flg").val());
        set_sales_flg($("#sales_flg").val());


        var merchandise_image_t_info = @json($merchandise_image_t_info);
        
        set_merchandise_image(merchandise_image_t_info["merchandise_image_t"]);
        merchandise_image_t_max_count = merchandise_image_t_info['max_count'];
        set_merchandise_display_order();

    });

    // 画面幅が変更されたときに実行させたい処理内容
    $(window).resize(function(){                 
        change_screen();
    });

    function change_screen(){       
    }   

    $(document).on("click", ".used_flg-area", function (e) {     

        var target = $(this).data('target');

        var used_flg = $("#used_flg").val();

        if(target == used_flg){
            return false;
        }  

        set_used_flg(target);
    });

    $(document).on("click", ".merchandise_image_used_flg-area", function (e) {     

        var target = $(this).data('target');

        var merchandise_image_used_flg = $("#merchandise_image_used_flg").val();

        if(target == merchandise_image_used_flg){
            return false;
        }  

        set_merchandise_image_used_flg(target);
    });

    $(document).on("click", ".sales_flg-area", function (e) {     

        var target = $(this).data('target');

        var sales_flg = $("#sales_flg").val();

        if(target == sales_flg){
            return false;
        }  

        set_sales_flg(target);
    });

    $(document).on("click", ".image_upload-modal-button", function (e) {

        var branch_number = $(this).data('branchnumber');

        

        //削除ボタンを可視化
        $('.image_info_change-button[data-processbranch="0"]').removeClass('d-none');
        

        var title = "";
        var asset_path = "{{asset('img/no_image/no_image.jpeg')}}";
        var display_order = merchandise_image_t_max_count;    
        var used_flg = 1;

        if(branch_number == 0){
            //新規登録処理の為、削除ボタンを不可視化
            $('.image_info_change-button[data-processbranch="0"]').addClass('d-none');            
        }else{

            title = $(this).data('title');
            asset_path = $(this).data('assetpath');
            display_order = $(this).data('displayorder');
            used_flg = $(this).data('usedflg');

        }


        //プレビューエリアを初期化
        $("#merchandise-image-preview-area").empty();                     

        // img要素を作成            
        const img = document.createElement("img");
        img.setAttribute('class', 'merchandise-image');           

        // URLをimg要素にセット
        img.src = asset_path;

        const merchandise_image_area = document.getElementById("merchandise-image-preview-area");

        // #Previewの中に追加
        merchandise_image_area.appendChild(img);

        $("#branch_number").val(branch_number);
        $("#merchandise_image_title").val(title);
        $("#merchandise_image_display_order").val(display_order);
        $("#merchandise_image_used_flg").val(used_flg);
        
        set_merchandise_image_display_order();
        set_merchandise_image_used_flg($("#merchandise_image_used_flg").val());
        //画像変更フラグを再セット
        $("#image_change_flg").val(0);

        // モーダルを表示する
        $("#image_upload-modal").modal('show');
    });

    //画像の利用フラグ変更時
    $('#merchandise_image_used_flg').on('change', function(event) {
        set_merchandise_image_display_order();
    })

    function set_merchandise_image_display_order() {

        var merchandise_image_used_flg = $("#merchandise_image_used_flg").val();
        $('#merchandise_image_display_order').removeClass('inoperable');

        if(merchandise_image_used_flg == 0){
            $('#merchandise_image_display_order').addClass('inoperable');
        }
    }


    $(document).on("click", ".merchandise-image-input-button", function (e) {
        $('#merchandise_image_input').click();
    });


    $(document).on("click", ".url-confirmation-button", function (e) {

        var sales_url = $('#sales_url').val();

        $("#sales_url").removeClass('is-invalid');
        if(sales_url == ""){
            alert("URLを入力してください");
            $("#sales_url").addClass('is-invalid');
            return false;
        }

        window.open(sales_url, '_blank');
    });


  
    
	merchandise_image_input.addEventListener('change', function () {

		// 選択したファイルの全情報取得
		let element = document.getElementById('merchandise_image_input');

		// 選択したファイルをファイル名で格納
		let files = element.files;			

		PreviewFile(this.files[0],1);        
    });    


    function PreviewFile(file,target) {
        
		// プレビュー内で表示している画像を一旦全削除
		$("#merchandise-image-preview-area").empty();

        // FileReaderオブジェクトを作成
        const reader = new FileReader();

        // URLとして読み込まれたときに実行する処理
        reader.onload = function (e) {

            // URLはevent.target.resultで呼び出せる
            const imageUrl = e.target.result;

            // img要素を作成
            // ("embed")...jpeg,img,pingは通常表示、PDFファイルはスクロールバー付きで表示
            const img = document.createElement("img");
            img.setAttribute('class', 'merchandise-image');           

            // URLをimg要素にセット
            img.src = imageUrl;

            const merchandise_image_area = document.getElementById("merchandise-image-preview-area");

            // #Previewの中に追加
            merchandise_image_area.appendChild(img);
           
        }

        // ファイルをURLとして読み込む
        reader.readAsDataURL(file);

        //画像変更フラグを再セット
        $("#image_change_flg").val(1);
    }


    // リセットボタン押下イベント
	$('.reset-button').on('click', function() {
		merchandise_image_reset();       
    });


    function merchandise_image_reset() {

        // プレビュー内で表示している画像を一旦全削除
        $("#merchandise-image-preview-area").empty();		
		$('.reset-button').blur();
                
        document.getElementById('merchandise_image_input').value = '';        
        $("#merchandise-image-preview-area").html(no_image_element);        

    }

    const selectedFiles = [];

    $('#merchandise_image_input').on('change', function(event) {
        selectedFiles.push(event.target.files)
    })



    // 画像更新関連button
    $('.image_info_change-button').click(function(){
    
        var process_branch = $(this).data('processbranch');
        var image_change_flg = $("#image_change_flg").val();
        
        // 画像登録処理かつ画像変更時は画像設定されているかチェックする        
        if(process_branch == 0 || image_change_flg == 1){

            // 画像選択チェック
            var imageInput = $('#merchandise_image_input')[0];
            if (imageInput.files.length === 0) {
                alert("画像が設定されていません。");            
                return;
            }
        }

        // ２重送信防止
        // 保存tを押したらdisabled, 10秒後にenable
        $(this).prop("disabled", true);

        setTimeout(function () {
            $('.image_info_change-button').prop("disabled", false);            
        }, 3000);

        var merchandise_id = $("#merchandise_id").val();
        var branch_number = $("#branch_number").val();

        var title = $("#merchandise_image_title").val();
        var used_flg = $("#merchandise_image_used_flg").val();
        var display_order = $("#merchandise_image_display_order").val();
        
        var form_data = new FormData($('#image_upload-form').get(0));
        form_data.append('merchandise_id', merchandise_id);
        form_data.append('branch_number', branch_number);
        form_data.append('image_change_flg', image_change_flg);
        form_data.append('process_branch', process_branch);
        form_data.append('title', title);
        form_data.append('used_flg', used_flg);
        form_data.append('display_order', display_order);
        

        let f = $('#image_upload-form');
        //マウスカーソルを砂時計に
        document.body.style.cursor = 'wait';

        $.ajax({
            url: f.prop('action'),
            type: f.prop('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: form_data,
        })
            // 送信成功
            .done(function (data, textStatus, jqXHR) {
                
                var result_array = data.result_array;

                var result = result_array["result"];

                if(result=='success'){                    

                    var merchandise_image_t_info = result_array["merchandise_image_t_info"];

                    set_merchandise_image(merchandise_image_t_info["merchandise_image_t"]);

                    merchandise_image_t_max_count = merchandise_image_t_info['max_count'];
                    set_merchandise_display_order();
                                        
                    document.body.style.cursor = 'auto';

                    $("#image_upload-modal").modal('hide');

                  
                }else{

                                
                    //{{-- ボタン有効 --}}
                    $('.image_info_change-button').prop("disabled", false);                    
                    //{{-- マウスカーソルを通常に --}}                    
                    document.body.style.cursor = 'auto';

                    var message = result_array["message"];

                    

                    //{{-- アラートメッセージ表示 --}}
                    var error_list = '';
                    error_list += '<li>' + message + '</li>';                     
                    
                    alert(message);
                    
                }

            
            })

            // 送信失敗
            .fail(function (data, textStatus, errorThrown) {
                
            
                //{{-- ボタン有効 --}}
                $('.image_info_change-button').prop("disabled", false);
                //{{-- マウスカーソルを通常に --}}                    
                document.body.style.cursor = 'auto';
                //{{-- エラーメッセージ表示 --}}
                var error_list = '';
                error_list += '<li>データ登録処理でエラーが発生しました</li>';          
                

            });
    });


    function set_merchandise_image(merchandise_image_t) {
   
        $('.merchandise-image-outer-area').empty();
        
        merchandise_image_t.forEach(function(info) {

            var add_class = "merchandise-image-opacity";
            var add_string = "非公開";

            if(info.used_flg == 1){
                add_class = "";
                add_string = "公開中";                        
            }

            // 新しい要素を作成
            var newElement = `
                <div class="merchandise-image-inner-area">
                    <div class="merchandise-image-title ${add_class}">
                        ${info.title}
                        <br>
                        ${add_string}
                    </div>
                    <div class="merchandise-image-area ${add_class}">
                        <img src="${info.asset_path}" class='merchandise-image' alt="">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-success mt-1 image_upload-modal-button" 
                            data-branchnumber="${info.branch_number}"
                            data-assetpath="${info.asset_path}"
                            data-title="${info.title}"
                            data-usedflg="${info.used_flg}"
                            data-displayorder="${info.display_order}">
                            編集
                        </button>
                    </div>
                </div>
            `;
            // merchandise-image-outer-areaに新しい要素を追加
            $('.merchandise-image-outer-area').append(newElement);
        });

        var maxHeight = 0;
    
        // 各 .merchandise-image-area 要素の高さを比較し、最大高さを取得する
        $('.merchandise-image-area').each(function(){
            var currentHeight = $(this).height();
            if(currentHeight > maxHeight){
                maxHeight = currentHeight;
            }
        });
        
        // 最大高さを持つ要素の高さを他の要素に設定する
        $('.merchandise-image-area').height(maxHeight);

    }


    function set_merchandise_display_order() {

        var select = $('#merchandise_image_display_order');
        select.empty(); // セレクトボックスをクリア

        for (var i = 1; i <= merchandise_image_t_max_count; i++) {
            select.append('<option value="' + i + '">' + i + '</option>');
        }

    }





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

        $.ajax({
            url: f.prop('action'), // 送信先
            type: f.prop('method'),
            dataType: 'json',
            data: f.serialize(),
        })
            // 送信成功
            .done(function (data, textStatus, jqXHR) {
                
                var result_array = data.result_array;

                var result = result_array["result"];

                if(result=='success'){

                    var url = "{{ route('settings.merchandise_m.index') }}";
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

