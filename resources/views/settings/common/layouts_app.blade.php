@php 
    $system_version = "?system_version=" . env('system_version');

    
    // https://johobase.com/font-awesome-icon-font-list-free/

    $route_array = [

        [
            'label' => '公開用Web',
            'route' => route('web.index'),
            'icon' => '<i class="fas fa-laptop-house fa-3x mb-1"></i>',
            'display' => true,
        ],

        [
            'label' => '管理者Menu',
            'route' => route('settings.menu'),
            'icon' => '',
            'display' => true,
        ],

        [
            'label' => 'インスタグラム管理',
            'route' => route('settings.instagram_t.index'),
            'icon' => '<i class="fab fa-instagram-square fa-3x mb-1"></i>',
            'display' => true,
        ],

        [
            'label' => '商品管理',
            'route' => route('settings.merchandise_m.index'),
            'icon' => '<i class="fas fa-apple-alt fa-3x mb-1"></i>',
            'display' => true,
        ],

        [
            'label' => '質問管理',
            'route' => route('settings.question_m.index'),
            'icon' => '<i class="fas fa-question-circle fa-3x mb-1"></i>',
            'display' => true,
        ],

        [
            'label' => 'ログアウト',
            'route' => route('settings.logout'),
            'icon' => '<i class="fas fa-child"></i>',
            'display' => true,
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
    <link href="{{ asset('css/style.css') . $system_version }}" rel="stylesheet">
    <link href="{{ asset('css/settings_style.css') . $system_version }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') . $system_version }}" rel="stylesheet">    
    
    <link rel="shortcut icon" href="{{ asset('img/logo/kukuna_logo.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/logo/kukuna_logo.png')}}" sizes="180x180">
    <link rel="icon" type="image/png" href="{{ asset('img/logo/kukuna_logo.png')}}" sizes="192x192">
    


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
    background-color: white;
}

#purchase_modal .modal-body{
    background-color: white;
}

#purchase_modal .modal-footer{
    background-color: white;
}



</style>


<div class="loader-area">
    <div class="loader">
    </div>
</div>

<body id="settings-body">

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

    {{-- PC --}}
    <div class="d-none d-md-block w-100">

        <!--ヘッダー-->
        <header class="m-0 p-0">

            
            <!--▽▽ヘッダーロゴ▽▽-->
                <div class="">
                    <a class="" href="{{ route('settings.menu') }}">
                        <img id="" src="{{ asset('img/logo/kukuna_sp.png') }}" class="kukuna_logo" alt="kukuna_logo">
                    </a>
                </div>
            
            <!--△△ヘッダーロゴ△△-->
            
                <h3 class="m-0 p-0" style="line-height: 60px;">
                    管理画面
                </h3>            

            <!--▽▽ヘッダーリスト▽▽-->
            
                <nav class="pc">  <!--pcクラスを追記-->
                    <ul>

                        @foreach ($route_array as $info)
                            @if($info["display"])
                                <li>
                                    <a href="{{$info['route']}}">                                
                                        {{$info['label']}}
                                    </a>
                                </li>
                            @endif
                        @endforeach

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
                <a class="p-0 m-0" href="{{ route('settings.menu') }}">
                    <img id="" src="{{ asset('img/logo/kukuna_sp.png') }}" class="kukuna_logo" alt="kukuna_logo">
                </a>
            </div>
            <!--△△ヘッダーロゴ△△-->
    

            <p class="m-0 p-0" style="line-height: 60px;">
                管理画面
            </p>
            
            
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
                            <li>
                                <a href="{{$info['route']}}">                                
                                    {{$info['label']}}
                                </a>
                            </li>
                        @endif
                    @endforeach                    
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



<script src="{{ asset('js/bootstrap.js') . $system_version}}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') . $system_version}}"></script>
<script src="{{ asset('js/app.js') . $system_version}}"></script>
<script src="{{ asset('js/common.js') . $system_version}}"></script>
<script src="{{ asset('js/settings.js') . $system_version}}"></script>
<script src="{{ asset('js/fontawesome.js') . $system_version}}"></script>


<!--▽▽jQuery▽▽-->
<script>

    $(function(){
        setTimeout(function(){
            end_loader();
        }, 1000);
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