@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', '商品一覧')

@endsection
@section('content')

<style>

#merchandise_description_modal_remarks{
    background-color: rgb(242, 247, 247);
    color: rgb(1, 27, 9);
}
</style>

<div id="main" class="mt-3 text-center container">

    <div class="row m-0 p-0">

        <div class="col-12">
        
            <div class="row mt-1 p-0">

                <div class="col-6 text-start">                    
                    <button type='button' class='btn btn-outline-primary page-transition-button' data-url="{{ route('web.merchandise')}}">商品紹介ページ</button>
                </div>
                <div class="col-6 text-end">                    
                    <button class='btn btn-success' type='button' onclick= "location.href='{{ route('settings.merchandise_m.settings_screen' ,['merchandise_id' =>0]) }}'">新規登録</button>
                </div>
            </div>

            <div id="data-display-area" class="m-0">            
            
                
                <table id='' class='data-info-table'>
                    @php
                        $text_class_kinds = ["text-start" , "text-center" , "text-end"];

                        $text_class = [];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[0];
                        $text_class []= $text_class_kinds[2];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[2];
                        $text_class []= $text_class_kinds[2];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[2];
                        $text_class_index = 0;
                    @endphp
                    <tr>
                        <th class="{{$text_class[$text_class_index++]}}">ID</th>
                        <th class="{{$text_class[$text_class_index++]}}">商品名</th>
                        <th class="{{$text_class[$text_class_index++]}}">料金</th>
                        <th class="{{$text_class[$text_class_index++]}}">販売状態</th>                                        
                        <th class="{{$text_class[$text_class_index++]}}">表示状態</th>
                        <th class="{{$text_class[$text_class_index++]}}">並び順</th>
                        <th class="{{$text_class[$text_class_index++]}}">画像数</th>
                        <th class="{{$text_class[$text_class_index++]}}">その他</th>
                        <th class="{{$text_class[$text_class_index++]}}"></th>
                        
                    </tr>

                    @foreach ($merchandise_m as $item)

                        @php                    
                            $text_class_index = 0;
                        @endphp

                        <tr>
                            {{-- 商品ID --}}
                            <td class="{{$text_class[$text_class_index++]}}">
                                {{$item->merchandise_id}}
                            </td>

                            {{-- 商品名 --}}
                            <td class="{{$text_class[$text_class_index++]}}">
                                {{$item->merchandise_name}}
                            </td>

                            {{-- 料金 --}}
                            <td class="{{$text_class[$text_class_index++]}}">
                                {{number_format($item->price)}}円
                            </td>

                            {{-- 販売状態 --}}
                            <td class="{{$text_class[$text_class_index++]}}">
                                @if($item->sales_flg == 1)
                                    販売
                                @else
                                    完売
                                @endif    
                            </td>
                                            

                            {{-- 表示状態 --}}
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

                            {{-- 並び順 --}}
                            <td class="{{$text_class[$text_class_index++]}}">
                                {{$item->display_order}}
                            </td>

                            {{-- 画像数 --}}
                            <td class="{{$text_class[$text_class_index++]}}">
                                {{count($item->merchandise_image_t)}}
                            </td>
                   

                            {{-- その他 --}}
                            <td class="{{$text_class[$text_class_index++]}}">
                                <button type="button" class="btn btn-outline-secondary" 
                                data-bs-toggle='modal' data-bs-target='#merchandise_description_modal'
                                data-merchandisename="{{$item->merchandise_name}}"
                                data-merchandisedescription="{!!$item->merchandise_description!!}"
                                >説明</button>


                                <button type="button" class="btn btn-outline-danger page-transition-button"                                 
                                data-url="{{$item->sales_url}}"                                
                                >販売サイト</button>          
                            </td>



                            <td class="{{$text_class[$text_class_index++]}}">
                                <button class='btn btn-outline-success' type='button' onclick= "location.href='{{ route('settings.merchandise_m.settings_screen' ,['merchandise_id' =>$item->merchandise_id]) }}'">修正</button>
                                <button class='btn btn-danger delete-button ml-1' type='button' data-id="{{$item->merchandise_id}}">削除</button>
                            </td>
                        
                        </tr>

                    @endforeach                    

                </table>

            </div>

        </div>      

    </div>
    
</div>




    
   
    {{-- 商品説明モーダル --}}
    <div class="modal fade" id="merchandise_description_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="merchandise_description_modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title" id=""><span id="merchandise_description_modal_title"></span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">                                                          
                    <textarea id="merchandise_description_modal_remarks" class="form-control" rows="20" cols="40" readonly></textarea>
                </div>

                <div class="modal-footer">               
                    <button type="button" id="" class="btn btn-secondary modal-close-button" data-bs-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>


{{-- エラーメッセージモーダルの読み込み --}}
@include('settings/common/error_message_modal')


@endsection

@section('pagejs')

<script type="text/javascript">

   
    //商品説明モーダル
    $('#merchandise_description_modal').on('show.bs.modal',function(e){
        // イベント発生元
        let evCon = $(e.relatedTarget);

        let merchandise_description = evCon.data('merchandisedescription');
        let merchandise_name = evCon.data('merchandisename');

        var title = merchandise_name + "の説明"
        $('#merchandise_description_modal_title').html(title);
        $('#merchandise_description_modal_remarks').val(merchandise_description);
        
    });


    $(document).on("click", ".delete-button", function (e) {

        var merchandise_id = $(this).data('id');

        var message = "削除処理を実行しますか？";    


        if(!confirm(message)){     
            return false;
        }

        start_processing("#main");

        // 送信先
        var url = "{{ route('settings.merchandise_m.delete') }}"

        $.ajax({	
                url: url,
                type: 'post',
                dataType: 'json',
                data: { 'merchandise_id' : merchandise_id },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}            
            })
                // 送信成功
                .done(function (data, textStatus, jqXHR) {
                    
                    end_processing();

                    var result_array = data.result_array;

                    var result = result_array["result"];                

                    if(result == 'success'){

                        location.reload();

                    }else{       

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

                    //{{-- エラーメッセージ表示 --}}
                    var error_list = '';
                    error_list += '<li>削除処理でエラーが発生しました。</li>';  

                    error_message_modal_show(error_list);

                            

                });


    });
 
</script>


@endsection

