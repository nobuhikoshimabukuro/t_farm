@extends('web.common.layouts_app')

@section('pagehead')
@section('title', 'WEB開発中承認画面')  

@endsection
@section('content')

<style>

    #password{
        width: 120px;
    }


</style>


<div class="mt-3 text-center container">

    <div class="row justify-content-center">                        
        
        <div class="col-12 mt-5 text-center p-0">
            <h3>
                たかすじファームWEB開発中
            </h3>
        </div>


        <div class="col-11 col-md-8 border rounded" style="padding: 1.25rem">
            
            <form action="{{ route('web.password_check_process') }}" id='approve_form' method="post" enctype="multipart/form-data">
                @csrf
                

                    <div class="d-inline-block">
                        <label for="password" class="text-lg-right">承認キー</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="tel" name="password" id="password" value="" class="text-end" maxlength="4">                    
                    </div>
                    
                    <div class="d-inline-block">
                        <button type="button" id='approve_button' class="btn btn-secondary">GO</button>
                    </div>                    

                

            
                 

            </form>

        </div>
        
    </div>

</div>









@endsection

@section('pagejs')

<script type="text/javascript">

  

$(function(){

$(document).ready(function () {        
    $('#password').focus();
});


$("#approve_form").keypress(function(e) {

    if(e.which == 13) {            
        // 判定
        if( document.getElementById("approve_button") == document.activeElement ){
            
            LoginProcess();      

        }else if( document.getElementById("password") == document.activeElement ){

            $('#approve_button').focus();
            return false;

        }else{
            return false;
        }            
    }

});    

$('#approve_button').click(function () {        
    LoginProcess();
});


function LoginProcess(){

    //{{-- メッセージクリア --}}
    $('.ajax-msg').html('');
    $('.is-invalid').removeClass('is-invalid');
    
    var password = $("#password").val();    

    if(password == ""){
        $('#password').focus();        
        $("#password").addClass("is-invalid");            
        return false;
    }


    //{{-- マウスカーソルを待機中に --}}         
    document.body.style.cursor = 'wait';

    // ２重送信防止
    // 保存tを押したらdisabled, 10秒後にenable
    $(this).prop("disabled", true);

    // 確認画面へ画面遷移
    $('#approve_form').submit(); 

}
});


</script>


@endsection

