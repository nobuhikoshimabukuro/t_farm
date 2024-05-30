@extends('web.common.layouts_app')

@section('pagehead')
@section('title', 'お問い合わせ')  

@endsection
@section('content')

<style>

/* Q&A  start */
.qa-007 {
    /* max-width: 500px; */
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 4px rgb(0 0 0 / 2%), 0 2px 3px -2px rgba(0 0 0 / 5%);
    background-color: #f4ebf5;
}

.qa-007 summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    padding: 1em 2em 1em 3em;
    color: #333333;
    font-weight: 600;
    cursor: pointer;
}

.qa-007 summary::before,
.qa-007 p::before {
    position: absolute;
    left: 1em;
    font-weight: 600;
    font-size: 1.3em;
}

.qa-007 summary::before {
    color: #75bbff;
    content: "Q";
}

.qa-007 summary::after {
    transform: translateY(-25%) rotate(45deg);
    width: 7px;
    height: 7px;
    margin-left: 10px;
    border-bottom: 3px solid #333333b3;
    border-right: 3px solid #333333b3;
    content: '';
    transition: transform .5s;
}

.qa-007[open] summary::after {
    transform: rotate(225deg);
}

.qa-007 p {
    position: relative;
    transform: translateY(-10px);
    opacity: 0;
    margin: 0;
    padding: .3em 3em 1.5em;
    color: #333;
    transition: transform .5s, opacity .5s;
}

.qa-007[open] p {
    transform: none;
    opacity: 1;
}

.qa-007 p::before {
    color: #ff8d8d;
    line-height: 1.2;
    content: "A";
}
/* Q&A  end */

/* お問い合わせの説明書き   start */
.explanation-area{
    padding: 1vh;
}

.explanation-area p{
    color: #270e04;    
    font-weight: 600;
}
/* お問い合わせの説明書き   end */


.form-table{
    min-width: 100%;
}

.form-table td{
    padding: 0 1vh;
    font-weight: 600;
}

.form-table textarea{
    resize: none;
}


#send_mail_button{
    margin-top: 1vh;
}






.flowing {
	width: 0;
	margin: 0;
	font-size: 19px;
	font-weight: bold;
	/* color: #ff6347; */
    color: #270e04;
	white-space: nowrap;
	overflow: hidden;
	animation: flowing-anim 3s forwards linear;
}

.flowing:nth-child(2) {
	animation-delay: 2.5s;
}


@keyframes flowing-anim {
 0%{
	 width: 0%;
   }
100%{
	 width: 100%;
   }
}



</style>

<div id="main" class="mt-3 container">


    <div class="merchandise-area row">      
        
        <div class="merchandise-name-area col-12 m-0 p-0 text-center">
            <h3 class="merchandise-name">
                よくあるご質問
            </h3>         
        </div>   

        <div class="col-12 info-box" style="padding: 1vh;">

            @foreach ($question_m as $index => $info)

                <details class="qa-007">
                                    
                    <summary>                        
                        {!! nl2br($info->question) !!}
                    </summary>

                    <p>
                        {!! nl2br($info->answer) !!}                        
                    </p>

                </details>

            @endforeach		

            {{-- <details class="qa-007">
                                
                <summary>
                    どのうように購入するのでしょうか？
                </summary>

                <p>
                    このHPからのご購入はできません。                    
                    大変ご不便をお掛け致しますが、BASEからのご購入をお願い致します。
                    <br>
                    参考:<a href="https://help.thebase.in/hc/ja/articles/115000085522-BASE" target="_blank">
                        <span style="color: blue">BASEとは
                        </span>
                        </a>
                    <br>
                    たかすじファーム:<a href="{{ env('base_url')}}" target="_blank">
                        <span style="color: blue">購入ページ
                        </span>
                        </a>

                    
                </p>

            </details>
            
            <details class="qa-007">
                                
                <summary>
                    沖縄県以外にも発送可能ですか？
                </summary>

                <p>
                    日本国内であれば発送可能です。
                    <br>                    
                    （2023年8月時点）
                    <br>
                    ※離島や特殊配達地域等への発送ご希望の場合は、                    
                    配達業者にご確認致しますので気軽にお問い合わせください。
                    
                    
                </p>

            </details>

            <details class="qa-007">
                                
                <summary>
                    農園見学等は行っていますか？
                </summary>

                <p>
                    農園見学は行っておりません。
                </p>
                
            </details> --}}

        </div>

    </div>






    <form action="{{ route('web.send_inquiry_mail_process') }}" id='send_mail_form' method="post" enctype="multipart/form-data">
        @csrf

        <div class="merchandise-area row">            
        

            <div class="merchandise-name-area col-12 m-0 p-0 text-center">
                <h3 class="merchandise-name">
                    お問い合わせ
                </h3>         
            </div>   

            <div class="info-box explanation-area col-12 col-xl-6 m-0">
                <p>
                    ご不明な点がございましたら気軽にお問い合わせください。
                    <br>
                    お問い合わせ後、自動返信メールがご指定頂いたメールアドレスに送られます。
                    <br>
                    自動返信のメールアドレスは
                    <br>
                    【{{ env('noreply_mailaddress') }}】
                    <br>
                    その後、担当者より数日以内に回答メールをお送り致します。
                    <br>
                    ※設定によっては迷惑メールに受信される可能性もございますので、確認を宜しくお願い致します。
                </p>
            </div>
        

            <div class="info-box col-12 col-xl-6 m-0">

                <table class="form-table">

                    <tr>
                        <td class="text-start">
                            氏名
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" name="inquirer_name" id="inquirer_name" value="" class="form-control text-start" 
                            placeholder="仮名でも構いません">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-start">
                            メールアドレス
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" name="mailaddress" id="mailaddress" value="" class="form-control text-start"
                            placeholder="mango@example.com">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-start">
                            お問い合わせ
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <textarea name="question" id="question" value="" class="form-control text-start" rows="5" 
                            placeholder="お問い合わせ内容をお書き下さい。"></textarea>
                                                    
                        </td>
                    </tr>

                    <tr>
                        <td class="text-end">
                            <button type="button" id='send_mail_button' class="btn btn-secondary">問い合わせる</button>                            
                        </td>
                    </tr>

                </table>              

            </div>

        </div>


    </form>
    

    {{-- お問い合わせ開始時のモーダル --}}
    <div class="modal fade" id="info_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="info_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-fluid">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="info_modal_label"></h5>
                    <button type="button" class="btn-close info_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

              
                <div class="modal-body">
                    <div class="modal-body-message-area text-center">  
                        <p class="flowing text-center">お問い合わせ内容を送信中です。</p>
                    </div>                    
                </div>  

                
                <div class="modal-footer row">
                    <div class="col-6 m-0 p-0 text-end">
                        <button type="button" id="" class="btn btn-secondary info_modal_close" data-bs-dismiss="modal">閉じる</button>
                    </div>  
                </div>  

            </div>
        </div>
    </div>
    
    
</div>









@endsection

@section('pagejs')

<script type="text/javascript">

    $(document).on("click", "#send_mail_button", function (e) {
        SendMail();
    });

    function SendMail(){

        var judge = true;

        //{{-- メッセージクリア --}}        
        $('.is-invalid').removeClass('is-invalid');

        var question = $("#question").val();        

        if(question == ""){
            $("#question").addClass("is-invalid");   
            $('#question').focus();               
            judge = false;
        }

        var mailaddress = $("#mailaddress").val();        

        if(mailaddress == ""){
            $("#mailaddress").addClass("is-invalid");   
            $('#mailaddress').focus();               
            judge = false;
        }

        var inquirer_name = $("#inquirer_name").val();        

        if(inquirer_name == ""){
            $("#inquirer_name").addClass("is-invalid");   
            $('#inquirer_name').focus();               
            judge = false;
        }
        

        if(judge == false){
            return false;
        }


        // もしキャンセルをクリックしたら
        if (!confirm('お問い合わせ内容を送信しますか？')) {
            return false;                
        }





        // モーダル表示
        $('#info_modal').modal('show');
        // モーダル閉じるボタンを比活性
        $('.info_modal_close').prop('disabled', true);
      
        let f = $('#send_mail_form');

        $.ajax({
            url: f.prop('action'), // 送信先
            type: f.prop('method'),
            dataType: 'json',
            data: f.serialize(),
        })
            // 送信成功
            .done(function (data, textStatus, jqXHR) {
                
                //{{-- ボタン有効 --}}
                $('#send_mail_button').prop("disabled", false);

                // モーダル閉じるボタンを活性
                $('.info_modal_close').prop('disabled', false);
                
                var ResultArray = data.ResultArray;

                var Result = ResultArray["Result"];
                
                $('.modal-body-message-area').html("");

                if(Result=='success'){
                
                    
                    display_html = '<p class="flowing text-center">お問い合わせ内容をお送り致しました。</p>';                               

                    $('.modal-body-message-area').html(display_html);

                 

                }else{

                    var ErrorMessage = ResultArray["Message"];

                    
                    
                    display_html = '<p class="flowing text-center">お問い合わせ内容をお送り致しました。</p>';           

                        //{{-- アラート --}}
                    $('.modal-body-message-area').html(display_html);
                    //{{-- 画面上部へ --}}

                  

                }

            
            })

            // 送信失敗
            .fail(function (data, textStatus, errorThrown) {
                

                $('.modal-body-message-area').html("");

                display_html = '<p class="flowing text-center">お問い合わせ内容をお送り致しました。</p>';           

                //{{-- アラート --}}
                $('.modal-body-message-area').html(display_html);
                // モーダル閉じるボタンを活性
                $('.info_modal_close').prop('disabled', false);
                
             
                //{{-- 画面上部へ --}}
                // $("html,body").animate({
                //     scrollTop: 0
                // }, "300");
               

            });


    }

</script>


@endsection

