@extends('settings.common.layouts_app')

@section('pagehead')
@section('title', '管理者メニュー')  

@endsection
@section('content')

@php

$route_array = [

        [
            'label' => '公開用Web',
            'route' => route('web.index'),
            'icon' => 'fas fa-laptop-house fa-3x mb-1',
            'display' => true,
        ],

        [
            'label' => '管理者Menu',
            'route' => route('settings.menu'),
            'icon' => '',
            'display' => false,
        ],

        [
            'label' => 'インスタグラム管理',
            'route' => route('settings.instagram_t.index'),
            'icon' => 'fab fa-instagram-square fa-3x mb-1',
            'display' => true,
        ],

        [
            'label' => '商品管理',
            'route' => route('settings.merchandise_m.index'),
            'icon' => 'fas fa-apple-alt fa-3x mb-1',
            'display' => true,
        ],

        [
            'label' => '質問管理',
            'route' => route('settings.question_m.index'),
            'icon' => 'fas fa-question-circle fa-3x mb-1',
            'display' => true,
        ],

        [
            'label' => 'systemCheck',
            'route' => route('settings.system_check'),            
            'icon' => '',
            'display' => true,
        ]
    ];
@endphp
<style>


</style>

<div id="main" class="mt-3 text-center container">

    <div class="row">

        @foreach ($route_array as $info)
            @if($info["display"])
                <div class="col-6 col-md-4 col-xl-3 p-3 ">
                    <a href="{{$info['route']}}">
                        
                        <div class="bg-info rounded-lg text-light p-2 ">                            
                            <i class="{{$info['icon']}}"></i>
                            <h6>{{$info['label']}}</h6>
                        </div>
                    </a>
                </div>              
            @endif
        @endforeach

    </div>    
    
</div>









@endsection

@section('pagejs')

<script type="text/javascript">

</script>


@endsection

