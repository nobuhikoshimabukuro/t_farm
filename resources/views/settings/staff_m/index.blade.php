@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', '商品一覧')

@endsection
@section('content')

<style>


</style>

<div id="main" class="mt-3 text-center container">    

    <div class="row m-0 p-0">

        <div class="col-12">
        
            <div id="data-display-area" class="scroll-wrap-x m-0">            
            
                <table id='' class='data-info-table'>
                    
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>料金</th>
                        <th>表示状態</th>
                        <th></th>
                        <th>並び順</th>
                        <th>
                            <button class='btn btn-primary' type='button' onclick= "location.href='{{ route('settings.merchandise_m.settings_screen' ,['merchandise_id' =>0]) }}'">新規登録</button>
                        </th>
                    </tr>

                    @foreach ($merchandise_m as $item)
                        <tr>

                            <td>{{$item->merchandise_id}}</td>
                            <td>{{$item->merchandise_name}}</td>
                            <td class="text-end">{{number_format($item->price)}}円</td>

                          

                            <td>
                                @if($item->used_flg == 1)
                                    表示中
                                @else
                                    非表示
                                @endif                            
                            </td>                          

                            <td>

                                <button type="button" class="btn btn-outline-primary" 
                                data-bs-toggle='modal' data-bs-target='#merchandise_description_modal'
                                data-merchandisename="{{$item->merchandise_name}}"
                                data-merchandisedescription="{!!$item->merchandise_description!!}"
                                >説明</button>


                                <button type="button" class="btn btn-outline-primary base_page_button"                                 
                                data-url="{{$item->sales_url}}"                                
                                >BasePage</button>                                      
                            
                            </td>





                            <td>{{$item->display_order}}</td>
                            <td>
                                <button class='btn btn-success' type='button' onclick= "location.href='{{ route('settings.merchandise_m.settings_screen' ,['merchandise_id' =>$item->merchandise_id]) }}'">修正</button>
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
                    <h5 class="modal-title" id=""><span id="merchandise_description_modal_title"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">                                                          
                    <textarea id="merchandise_description_modal_remarks" class="form-control" rows="4" cols="40" readonly></textarea>
                </div>

                <div class="modal-footer">               
                    <button type="button" id="" class="btn btn-secondary modal-close-button" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>








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

    
    //求人補足選択値変更時
    $(document).on("click", ".base_page_button", function (e) {

        var url = $(this).data('url');
        window.open(url, '_blank');
    });


</script>


@endsection

