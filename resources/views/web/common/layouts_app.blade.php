@php 
    $system_version = "?system_version=" . env('system_version');


    $menu_select_image = asset('img/logo/menu.png');


    $currentRouteName = Route::currentRouteName();
    $route_array = [

        [
            'label' => '管理者',
            // 'route' => route('settings.menu'),
            'route' => 'settings.menu',
            'src' => asset('img/logo/0003.jpg'),
            'display' => false,
        ],

        [
            'label' => 'TOP',
            // 'route' => route('web.index'),
            'route' => 'web.index',
            'src' => asset('img/logo/0003.jpg'),
            'display' => true,
        ],

        [
            'label' => '商品紹介',
            // 'route' => route('web.merchandise'),
            'route' => 'web.merchandise',
            'src' => asset('img/logo/0003.jpg'),
            'display' => true,
        ],

        [
            'label' => 'お問い合わせ',
            // 'route' => route('web.inquiry'),
            'route' => 'web.inquiry',
            'src' => asset('img/logo/0003.jpg'),
            'display' => true,
        ],

        [
            'label' => '農園情報',
            // 'route' => route('web.farminfo'),
            'route' => 'web.farminfo',
            'src' => asset('img/logo/0003.jpg'),
            'display' => false,
        ]
    ];
@endphp

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/all.css') . $system_version}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') . $system_version }}" rel="stylesheet">
    <link href="{{ asset('css/swiper-bundle.min.css') . $system_version }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') . $system_version }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/header.css') . $system_version }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/header2.css') . $system_version }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') . $system_version }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=M+PLUS+1p&family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
    
    <link rel="shortcut icon" href="{{ asset('img/logo/kukuna_logo_2.ico') . $system_version}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo/kukuna_logo_2.png') . $system_version}}" sizes="180x180">
    <link rel="icon" type="image/png" href="{{ asset('img/logo/kukuna_logo_2.png') . $system_version}}" sizes="192x192">
    

    <meta name="thumbnail" content="{{ asset('img/logo/kukuna_logo_2.png') . $system_version}}" >
    <meta name="csrf-token" content="{{ csrf_token() }}">  {{-- CSRFトークン --}}
    <PageMap>
        <DataObject type="thumbnail">
           <Attribute name="src" value="{{ asset('img/logo/kukuna_logo_2.png') . $system_version}}"/>
              <Attribute name="width" value="120"/>
              <Attribute name="height" value="120"/>
        </DataObject>
    </PageMap>



    
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
    background-color: white;
}

#purchase_modal .modal-body{
    background-color: white;
}

#purchase_modal .modal-footer{
    background-color: white;
}




header {

    /* background: url("{{ asset('img/logo/footer.jpg') }}") center center; */
    /* background: url("{{ asset('img/logo/header.jpg') }}") no-repeat center center; */

}
.footer {
  
  /* background: url("{{ asset('img/logo/instagram.png') }}") no-repeat center center; */
  /* background-size: cover; */
  /* background: url("{{ asset('img/logo/instagram.png') }}") center center; */
  background: url("{{ asset('img/logo/footer.jpg') }}") center center;
  
  text-align: center;            
  color: white;            
  width: 100%;
  box-sizing: border-box;

  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;    
  text-align: center;
}
.footer-content {
  background-color: rgba(0, 0, 0, 0.5); 
  padding: 10px;
}


.active{
    font-size: 1.1rem;
    color: #0a58ca;
}


.menu_select{
    height: 1.1rem;
    width: 1.1rem;
    margin-bottom: 3px;
}

.aaa{
    color: rgb(4, 2, 33);
    font-size: 1.2rem;
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

        $header_flg = true;

    @endphp

    @if($header_flg)



    <div class="d-none d-md-block w-100">
       
        <header class="m-0 p-0 header1">

            

            <div class="">
                <a class="" href="{{ route('web.index') }}">
                    <img id="" src="{{ asset('img/logo/kukuna_sp_2.png') }}" class="kukuna_logo" alt="kukuna_logo">
                </a>
            </div>
                   
        
            <h3 class="m-0 p-0" style="line-height: 60px;">
                {{-- KUKUNA FARM --}}
            </h3>
            <nav class="pc">
                <ul>
                    @foreach ($route_array as $info)
                        @if($info["display"])

                            @php
                                $add_class = "";                                
                                if($info['route'] == $currentRouteName){
                                    $add_class = "active";
                                }
                            @endphp

                            <li class="">
                                <a class="{{$add_class}}" href="{{route($info['route'])}}">  
                                    @if($add_class != "")
                                        <img id="" src="{{$menu_select_image}}" class="menu_select" alt="mango">                                              
                                    @endif
                                    {{$info['label']}}                                                     
                                </a>
                            </li>
                        @endif
                    @endforeach                        
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
        
    </header>

    </div>


    {{-- スマホ --}}
    <div class="d-block d-md-none w-100">

        <header class="p-0 m-0 header2">

             <!--▽▽ヘッダーロゴ▽▽-->
             <div class="">
                <a class="p-0 m-0" href="{{ route('web.index') }}">
                    <img id="" src="{{ asset('img/logo/kukuna_sp_2.png') }}" class="kukuna_logo" alt="kukuna_logo">
                    {{-- <img id="" src="{{ asset('img/logo/kukuna.png') }}" class="kukuna_logo" alt="logo"> --}}
                </a>
            </div>
            <!--△△ヘッダーロゴ△△-->

            <p class="m-0 p-0" style="line-height: 60px;">
                {{-- KUKUNA FARM --}}
            </p>
    
            <!--▽▽カートロゴ▽▽-->
            {{-- <button class='cart_logo_btn' data-bs-toggle='modal' data-bs-target='#purchase_modal'>
                <img src="{{ asset('img/logo/cart.png') }}" class='cart_logo' alt="cart_logo">
            </button>      --}}
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

                    @foreach ($route_array as $info)
                        @if($info["display"])

                            @php
                                $add_class = "";

                                if($info['route'] == $currentRouteName){
                                    $add_class = "active";
                                }
                            @endphp
                            <li class="li-dark">
                                <a class="{{$add_class}}" href="{{route($info['route'])}}">        
                                    <img id="" src="{{$info['src']}}" class="merchandise_logo" alt="kukuna_logo">                       
                                    {{$info['label']}}

                                    @if($add_class != "")
                                        <img id="" src="{{$menu_select_image}}" class="menu_select" alt="mango">                                              
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endforeach                    
                    
                    <li class="li-dark">
                        <a class="" href="{{ env('instagram_url')}}" target="_blank">                            
                            <img src="{{ asset('img/logo/instagram.png') }}" class="instagram_logo" alt="instagram">
                            instagram
                        </a>
                    </li> 
                    
                    <li class="li-clear">
                        <a class="" data-bs-toggle='modal' data-bs-target='#purchase_modal'>                            
                            <img src="{{ asset('img/logo/cart.png') }}" class="instagram_logo" alt="cart">
                            購入ページへ
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





    <!-- ページトップへ戻るボタン -->
    {{-- <div id="page_top"><a href="#"></a></div> --}}
    <a class="pagetop" href="#"><div class="pagetop__arrow"></div></a>
    {{-- </div> --}}
  
    

@yield('content')

    <footer class="footer">
        <div class="footer-content">
            &copy; KUKUNA FARM. All rights reserved.
        </div>
    </footer>

    
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
                        農園直送ですが、販売はBASEにて行っております。
                        <br>
                        BASEでも販売品や料金を確認できます。
                        <br>
                        <a href="{{ env('base_url')}}" target="_blank" class="underline">
                            ククナファーム購入ページ
                        </a>
                        
                        <br>
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
    

<script src="{{ asset('js/bootstrap.js') . $system_version}}"></script>
<script src="{{ asset('js/swiper-bundle.min.js') . $system_version}}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') . $system_version}}"></script>
<script src="{{ asset('js/app.js') . $system_version}}"></script>
<script src="{{ asset('js/common.js') . $system_version}}"></script>
<script src="{{ asset('js/fontawesome.js') . $system_version}}"></script>


<!--▽▽jQuery▽▽-->
<script>

    $(function(){

        setTimeout(function(){
            end_loader();
        }, 500);

        // set_main_minheight();
    });

    
    // 画面幅が変更されたときに実行させたい処理内容
    $(window).resize(function(){                 
        // set_main_minheight();
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