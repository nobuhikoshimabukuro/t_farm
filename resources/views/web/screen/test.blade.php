
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="http://127.0.0.1:8000/css/all.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/bootstrap.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/style.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/header.css" rel="stylesheet">    
    
    <link rel="shortcut icon" href="http://127.0.0.1:8000/img/logo/logo.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="http://127.0.0.1:8000/img/logo/logo.png" sizes="180x180">
    <link rel="icon" type="image/png" href="http://127.0.0.1:8000/img/logo/logo.png" sizes="192x192">
    


    <meta name="csrf-token" content="o0am4WfZK6qngjkdGJW6aRRcxmGYJzvDLQdf2ZWP">  
      

    <title>確認画面</title>


</head>

<style>

</style>

<body>
   


<div class="mt-3 text-center container">

    <form action="{{ route('password_check_process') }}" id='approve_form' method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">                    

            <div class="row m-1">                    
                
                <div class="col-12 text-center">                    
                    <h4>web開発中</h4>
                </div>
            </div>       
          
            <div class="row m-1">           
                <div class="col-4 text-end">
                    <label for="" class="col-form-label original-label">パスワード</label>
                </div>
                <div class="col-4">                    
                    <input type="hidden" name="desired_url" id="" value="{{session('desired_url')}}" class="form-control">
                    <input type="password" name="password" id="password" value="" class="form-control text-end">
                </div>

                <div class="col-4 text-start">
                    <button type="button" id='approve_button' class="btn btn-secondary">GO</button>
                </div>      
            </div>           

            @if(session('password_check_nerror'))
            
                <div class="row ajax-msg">                     
                    <div class="alert alert-danger text-center">
                        パスワード不一致 
                    </div>                    
                </div>   
            @endif

        </div>      


    </form>

    
</div>









<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
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



</body>

</html>