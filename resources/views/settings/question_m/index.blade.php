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
        
            <div class="row m-0 p-0 ">
                <div class="col-12 text-end">                    
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
                        $text_class []= $text_class_kinds[0];
                        $text_class []= $text_class_kinds[1];
                        $text_class []= $text_class_kinds[2];                        
                        $text_class_index = 0;
                    @endphp
                    <tr>
                        <th class="{{$text_class[$text_class_index++]}}">ID</th>
                        <th class="{{$text_class[$text_class_index++]}}">Q&A</th>
                        <th class="{{$text_class[$text_class_index++]}}">答え</th>
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
                            </td>
                        
                        </tr>

                    @endforeach                    

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

   

</script>


@endsection

