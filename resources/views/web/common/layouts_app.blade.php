@php 
    $system_version = "?system_version=" . env('system_version');
@endphp

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/all.css') . $system_version}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') . $system_version }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') . $system_version }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') . $system_version }}" rel="stylesheet">    
    
    <link rel="shortcut icon" href="{{ asset('img/logo/logo.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo/logo.png')}}" sizes="180x180">
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logo.png')}}" sizes="192x192">
    


    <meta name="csrf-token" content="{{ csrf_token() }}">  {{-- CSRFトークン --}}
    @yield('pagehead')
    <title>@yield('title')</title>


</head>

<style>


.pagetop {
    display: none;/* 非表示 */
    height: 50px;
    width: 50px;
    position: fixed;
    right: 3vw;
    bottom: 3vh;
    background-color:rgb(89,240, 250) ;
    opacity: 0.6;
    /* border: solid 1px #000;
    border-radius: 50%; */
    /* display: flex; */
    justify-content: center;
    align-items: center;
    z-index: 2;
}


/* activeクラスが付与されたとき */
.pagetop.active {
    display: flex;
}


.pagetop__arrow {
    height: 10px;
    width: 10px;
    border-top: 3px solid #f5f7f9;
    border-right: 3px solid#f5f7f9;
    transform: translateY(20%) rotate(-45deg);
}


#purchase_modal p{
  font-weight: 600;
  color: rgb(2, 2, 43);
}

#purchase_modal .modal-header{
    background-color: rgb(241, 249, 238)
}

#purchase_modal .modal-body{
    background-color: rgb(240, 241, 237)
}

#purchase_modal .modal-footer{
    background-color: rgb(241, 249, 238)
}


.underline{
  border-bottom: dotted 2px blue;
}



</style>


<div class="loader-area">
    <div class="loader">
    </div>
</div>

<body>

    @php

        $header_flg = false;

        if ((session()->exists('login_flg'))) {

            $login_flg = session()->get('login_flg');

            //login_flgが'1'はsession確認OK
            if ($login_flg == 1) {
                $header_flg = true;
            }
        }


    @endphp

    @if($header_flg)

    {{-- PC --}}
    <div class="d-none d-md-block w-100">

        <!--ヘッダー-->
        <header class="m-0 p-0">

            
            <!--▽▽ヘッダーロゴ▽▽-->
                <div class="">
                    <a class="" href="{{ route('web.index') }}">
                        <img id="" src="{{ asset('img/logo/tf_logo.png') }}" class="tf_logo" alt="tf_logo">
                    </a>
                </div>
            
            <!--△△ヘッダーロゴ△△-->


            
                <h3 class="m-0 p-0" style="line-height: 60px;">
                    たかすじファーム
                </h3>              
            

            {{-- <div class="title">                
                <p>
                    沖縄の太陽と風を詰め込んだ<br>絶品のマンゴーをお楽しみください。
                </p>
            </div> --}}


            <!--▽▽ヘッダーリスト▽▽-->
            
                <nav class="pc">  <!--pcクラスを追記-->
                    <ul>

                        <li>
                            <a href="{{ route('settings.menu') }}">                                
                                管理者
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('web.index') }}">
                                TOP
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('web.merchandise') }}">
                                商品紹介
                            </a>
                        </li>
        
                        <li>
                            <a href="{{ route('web.inquiry') }}">
                                お問い合わせ
                            </a>
                        </li>
    
                        <li>
                            <a href="{{ route('web.farminfo') }}">
                                農園情報
                            </a>
                        </li>
                        
                        <li>
                            <a class="" href="{{ env('instagram_url')}}" target="_blank">
                                <img src="{{ asset('img/logo/instagram.png') }}" class="instagram_logo" alt="instagram">
                            </a>
                        </li>  


                        <button class='cart_logo_btn' data-bs-toggle='modal' data-bs-target='#purchase_modal'>
                            <img src="{{ asset('img/logo/cart.png') }}" class='cart_logo' alt="cart_logo">
                        </button>     


                    </ul>
                </nav>
            
            <!--△△ヘッダーリスト△△-->
            
        </header>

    </div>


    {{-- スマホ --}}
    <div class="d-block d-md-none w-100">

        <header class="p-0 m-0">

             <!--▽▽ヘッダーロゴ▽▽-->
             <div class="">
                <a class="p-0 m-0" href="{{ route('web.index') }}">
                    <img id="" src="{{ asset('img/logo/tf_logo.png') }}" class="tf_logo" alt="tf_logo">
                </a>
            </div>
            <!--△△ヘッダーロゴ△△-->
    
            <!--▽▽カートロゴ▽▽-->
            <button class='cart_logo_btn' data-bs-toggle='modal' data-bs-target='#purchase_modal'>
                <img src="{{ asset('img/logo/cart.png') }}" class='cart_logo' alt="cart_logo">
            </button>     
            <!--△△カートロゴ△△-->
            
            <!--▽▽ハンバーガーメニュー▽▽-->
            <div id="hamburger">                       
                <div class="icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <!--△△ハンバーガーメニュー△△-->
    
    
            <!--▽▽ハンバーガーメニューのリスト▽▽-->
            <nav class="sm">
                <ul>

                    <li>
                        <a href="{{ route('settings.menu') }}">
                            <img id="" src="{{ asset('img/logo/0003.jpg') }}" class="merchandise_logo" alt="tf_logo">
                            管理者
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.index') }}">
                            <img id="" src="{{ asset('img/logo/0003.jpg') }}" class="merchandise_logo" alt="tf_logo">
                            TOP
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.merchandise') }}">
                            <img id="" src="{{ asset('img/logo/0003.jpg') }}" class="merchandise_logo" alt="tf_logo">
                            商品紹介
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.inquiry') }}">                            
                            <img id="" src="{{ asset('img/logo/0003.jpg') }}" class="merchandise_logo" alt="tf_logo">
                            お問い合わせ
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.farminfo') }}">                            
                            <img id="" src="{{ asset('img/logo/0003.jpg') }}" class="merchandise_logo" alt="tf_logo">
                            農園情報
                        </a>
                    </li>
                    
                    <li>
                        <a class="" href="{{ env('instagram_url')}}" target="_blank">                            
                            <img src="{{ asset('img/logo/instagram.png') }}" class="instagram_logo" alt="instagram">
                            instagram
                        </a>
                    </li>
                   
                    
                </ul>
            </nav>
            <!--△△ハンバーガーメニューのリスト△△-->

        </header>
        
    </div>

        
    

    <div id="empty_space" class="row p-0 m-0">

      
        
    </div>

    @endif

    {{-- 購入案内モーダル --}}
    <div class="modal fade" id="purchase_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="purchase_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="">ご購入を検討頂いている方へ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               
                <div class="modal-body">

                    <p>
                        販売はBASEにて行っております。
                        <br>
                        BASEで販売品や料金を確認できます。
                        <br>
                        <span class="emphasis item-flash">2023年の収穫分は多くのお客様からのご好評によりは完売致しました。
                            <br>
                            誠にありがとうございました。</span>
                        <br>
                        
                        <br>
                        <a href="{{ env('base_url')}}" target="_blank" class="underline">
                            たかすじファーム購入ページ
                        </a>
                        
                        <br>
                        <a href="https://help.thebase.in/hc/ja/articles/115000085522-BASE" target="_blank" class="underline">
                            BASEとは                                
                        </a>                       

                    </p>
                 
                    
                </div>

                <div class="modal-footer">               
                    <button type="button" id="" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>




    <!-- ページトップへ戻るボタン -->
    {{-- <div id="page_top"><a href="#"></a></div> --}}
    <a class="pagetop" href="#"><div class="pagetop__arrow"></div></a>
    {{-- </div> --}}
  
    

@yield('content')



<script src="{{ asset('js/bootstrap.js') . $system_version}}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') . $system_version}}"></script>
<script src="{{ asset('js/app.js') . $system_version}}"></script>
<script src="{{ asset('js/common.js') . $system_version}}"></script>
<script src="{{ asset('js/fontawesome.js') . $system_version}}"></script>


<!--▽▽jQuery▽▽-->
<script>

    $(window).on('load', function (){       
        end_loader();
    });


    $('#hamburger').on('click', function(){
        $('.icon').toggleClass('close');
        $('.sm').slideToggle();
    });

    $(window).on('scroll', function() {//スクロールしたとき、
        if ($(this).scrollTop() > 100) { //スクロール量が500px以上なら、
            $('.pagetop').addClass('active');    //activeクラスを付与し、
        } else {                         //500px未満なら、
            $('.pagetop').removeClass('active'); //activeクラスを外します。
        }
    });

</script>
<!--△△jQuery△△-->




@yield('pagejs')

</body>

</html>