@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', 'Q&A一覧')

@endsection
@section('content')

<style>


</style>

<div id="main" class="mt-3 text-center container">

    <div class="row m-0 p-0">

        <div class="col-12">
        
            <div class="row mt-1 p-0">

                <div class="col-6 text-start">                    
                    <button type='button' class='btn btn-outline-primary page-transition-button' data-url="{{ route('web.inquiry')}}">質問ページ</button>
                </div>
                <div class="col-6 text-end">                    
                    <button class='btn btn-success' type='button' onclick= "location.href='{{ route('settings.question_m.settings_screen' ,['question_id' =>0]) }}'">新規登録</button>
                </div>
            </div>

            <div id="data-display-area" class="m-0">            
            
                
                <table id='' class='data-info-table'>
                    @php
                        $text_class_kinds = ["text-start" , "text-center" , "text-end"];

                        $text_class = [];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[0];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[2];                        
                        $text_class_index = 0;
                    @endphp
                    <tr>
                        <th class="{{$text_class[$text_class_index++]}}">ID</th>
                        <th class="{{$text_class[$text_class_index++]}}">Q&A</th>
                        <th class="{{$text_class[$text_class_index++]}}">表示状態</th>
                        <th class="{{$text_class[$text_class_index++]}}">並び順</th>                                        
                        <th class="{{$text_class[$text_class_index++]}}"></th>
                        
                    </tr>

                    @foreach ($question_m as $item)

                        @php                    
                            $text_class_index = 0;
                        @endphp

                        <tr>
                            <td class="{{$text_class[$text_class_index++]}}">
                                {{$item->question_id}}
                            </td>

                            <td class="{{$text_class[$text_class_index++]}}">
                                <div class="">
                                    <label>Q.</label>
                                    {!! nl2br(e($item->question)) !!}
                                </div>

                                <div class="">
                                    <label>A.</label>
                                    {!! nl2br(e($item->answer)) !!}
                                </div>
                            </td>

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

                            <td class="{{$text_class[$text_class_index++]}}">
                                {{$item->display_order}}
                            </td>
                   
                            <td class="{{$text_class[$text_class_index++]}}">
                                <button class='btn btn-outline-success' type='button' onclick= "location.href='{{ route('settings.question_m.settings_screen' ,['question_id' =>$item->question_id]) }}'">修正</button>
                                <button class='btn btn-danger delete-button ml-1' type='button' data-id="{{$item->question_id}}">削除</button>
                            </td>
                        
                        </tr>

                    @endforeach                    

                </table>

            </div>

        </div>      

    </div>
    
</div>





{{-- エラーメッセージモーダルの読み込み --}}
@include('settings/common/error_message_modal')




@endsection

@section('pagejs')

<script type="text/javascript">


$(document).on("click", ".delete-button", function (e) {

    var question_id = $(this).data('id');

    var message = "削除処理を実行しますか？";    


    if(!confirm(message)){     
        return false;
    }

    start_processing("#main");

    // 送信先
    var url = "{{ route('settings.question_m.delete') }}"

    $.ajax({	
            url: url,
            type: 'post',
            dataType: 'json',
            data: { 'question_id' : question_id },
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

