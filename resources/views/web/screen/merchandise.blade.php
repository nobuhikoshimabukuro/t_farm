@extends('web.common.layouts_app')

@section('pagehead')
@section('title', '商品紹介')  

@endsection
@section('content')

<style>

.merchandise-area{  
  margin-bottom: 1vh;
  padding: 1vh;  
}

.merchandise-inner-area{  
    background-color: rgb(248, 248, 242);
    border: 0.5px solid rgb(248, 248, 215); 
    border-radius: 10px;
    height: 100%;
}

.merchandise-photo{    
    width: 100%;    
    height:  100%;
    object-fit: contain; 
}

.merchandise-name-area{
  /* background: linear-gradient(70deg, rgb(250, 222, 227), rgb(252, 224, 229)); */
}


.merchandise-name{
    text-emphasis: left;
    margin: 0;  
    padding: 0.5vh 0;
    color: #3b2525;
}





.main-photo-area{     
    top: 0;
    left: 0;
    width: 100%;
    height: 40vh;  
}

.photo-select-area{   
   overflow-x:auto;     
   /* overflow-x:none;     */
}

.photo-select-scroll-area{   
    object-fit: contain;
    display: flex; 
    /* justify-content: center; */
}


.sub-photo-div {  
    min-width:14vh; 
    max-width:14vh; 
    max-height:10vh; 
    min-height:10vh;  
    padding: 1px;   
    
}




.photo_button {
    width:100%;    
    height:100%;
    border: none;
    background: transparent;
}

.sub-photo{     
    width: 100%;    
    height:  100%;
    object-fit: contain;   
}


.select-border{    
    opacity: 1;
}

.none-select-border{
    opacity: 0.5;
}

.scroll-btn-area{    
}



.scroll-btn{
    height: 100%;
    width: 100%;
    border: none;
    background: transparent;
}

.arrow_logo{
    font-size: 25px;
    font-weight: 600;
    color: rgb(7, 124, 166);
}


.merchandise-explanation-area{
  text-align: left;
  padding: 0 1vh;
}

.merchandise-explanation{
  text-align: left;
  color: #3b2525;
  font-size: 1rem;
  padding: 1px;
}


.arrow-area{
    display: flex;
    justify-content: center; /*左右中央揃え*/
    align-items: center;     /*上下中央揃え*/
}

/* PC用 */
@media (min-width: 768px) {

    .main-photo-area img {
        border-radius: 10px;
    }

    .landscape_image {
        border-radius: 10px;
    }

    .arrow-area .arrow_logo{
        display:none;
    }

    .sub-photo:hover{         
        opacity: 0.8;
}
    
}

/* モバイル用 */
@media (max-width: 768px) {

    .scroll-btn-area{
        display:none;
        
    }    

    .arrow-area .arrow_logo{
        font-size: 20px;        
        opacity: 0.4;
    }   
}



.sale{
    text-align: center;
    padding: 3px;
    width: 4rem;
    font-size: 1rem;
    border: solid 1px blue;
    background: white;    
    color: blue;
    border-radius: 5px;
}

.base_move{
    text-align: center;
    margin-left: 1rem;
    padding: 3px;
    width: 6rem;
    font-size: 1rem;
    border: solid 1px blue;
    background: white;    
    color: blue;
    border-radius: 5px;
    cursor: pointer;    
}

.base_move:hover {    
    cursor: pointer;
    border: solid 1px rgb(2, 2, 136);
    font-weight: bold;
    background: blue;
    color: white;
}

.sold_out{
    text-align: center;
    padding: 3px;
    width: 4rem;
    font-size: 1rem;
    border: solid 1px red;
    background: white;    
    color: red;
    border-radius: 5px;
}

.price{
    margin: 0;
    padding: 0;
    font-size: 1.4rem;    
}



</style>

<div id="main" class="mt-3 text-center container">

   
    <div id="" class="row m-0 p-0">   
        
        <div class="col-12 m-0 ">

            <h3 class="test text-start">
                商品紹介
             </h3>
                
        </div>
    
        @foreach($merchandise_m as $info)

            @php
                $merchandise_id = $info->merchandise_id;
                $merchandise_name = $info->merchandise_name;
                $merchandise_description = $info->merchandise_description;
                $price = $info->price;
                $sales_url = $info->sales_url;                
                $sales_flg = $info->sales_flg;

                $merchandise_image_t = $info->merchandise_image_t;                
            @endphp




            <div id="merchandise{{$merchandise_id}}" class="merchandise-area col-12 col-md-6 m-0">

                <div id="" class="merchandise-inner-area">                    
                        
                    <div class="merchandise-name-area row m-1 p-0 text-center">                        
                        <h4 class="merchandise-name">
                            {{$merchandise_name}}
                        </h4>
                    </div>    

                    <div class="merchandise-info-area row m-1 p-0">                        
                        <div class="col-7 text-start d-flex" >
                            @if($sales_flg == 0)
                                <div class="sold_out">
                                    完売
                                </div>
                            @else
                                <div class="sale">
                                    販売中
                                </div>                                
                                <div class="base_move page-transition-button" data-url="{{$sales_url}}">
                                    購入ページ
                                </div>     
                            @endif
                        </div>

                        <div class="col-5 text-end">
                            <p class="price">
                                ￥{{number_format($price)}}
                            </p>
                            
                        </div>
                    </div> 


                    <div class="col-12 m-0 p-0">     

                        <div class="main-photo-area">                
                            @if(count($merchandise_image_t) > 0)
                                <img src="{{$merchandise_image_t[0]->asset_path}}" class="merchandise-photo" alt="{{$merchandise_image_t[0]->image_name}}">
                            @else
                                <img src="{{asset('img/no_image/no_image.jpeg')}}" class="merchandise-photo" alt="nonimage">
                            @endif
                            
                        </div>       

                        
                        <div class="row">

                            <div class="col-1 m-0 p-0 arrow-area">   
                                {{-- モバイル用矢印 --}}
                                <i class="fas fa-angle-double-left arrow_logo"></i>                                
                            </div>       
                            
                            <div class="col-1 m-0 p-0 scroll-btn-area">   
                                <button class="scroll-btn"
                                data-direction='1'
                                data-merchandiseid="{{$merchandise_id}}" 
                                >
                                        <i class="fas fa-angle-double-left arrow_logo"></i>
                                </button>                      
                            </div>       

                            <div class="photo-select-area col-10 col-md-8 m-0 p-0">

                                <div class="photo-select-scroll-area m-0 p-0">

                                    
                                    @foreach ($merchandise_image_t as $index => $image_info)

                                        <div id='' class="sub-photo-div">                                                
                                            <button type="button" id="" class="photo_button m-0 p-0"                         
                                            data-merchandiseid="{{$merchandise_id}}" 
                                            data-kinds="{{$index}}" 
                                            data-targetpath="{{$image_info->asset_path}}" 
                                            data-imagename="{{$image_info->image_name}}" 
                                            >
                                                
                                                    <img src="{{$image_info->asset_path}}" 
                                                        @if($index == 0) photo_select 
                                                            class="sub-photo kinds{{$index}} select-border" 
                                                        @else
                                                            class="sub-photo kinds{{$index}} none-select-border" 
                                                        @endif                                                    
                                                    alt="{{$image_info->image_name}}"
                                                    >
                                                
                                            </button>
                                        </div>

                                    @endforeach		
                                

                                </div>                        

                            </div>
                            
                            <div class="col-1 scroll-btn-area m-0 p-0">   
                                <button class="scroll-btn"
                                data-direction='2'
                                data-merchandiseid="{{$merchandise_id}}" 
                                >
                                    <i class="fas fa-angle-double-right arrow_logo"></i>
                                </button>                      
                            </div>   

                            <div class="col-1 m-0 p-0 arrow-area">
                                {{-- モバイル用矢印 --}}
                                <i class="fas fa-angle-double-right arrow_logo"></i>
                            </div>       

                        </div>

                        
                    </div>


                    
                    <div class="merchandise-explanation-area col-12 m-0">
                        <p class="merchandise-explanation">{!! nl2br($merchandise_description) !!}</p>                        
                    </div>

                </div>

            </div>
		
		@endforeach		

        

    </div>

</div>









@endsection

@section('pagejs')

<script type="text/javascript">

    $(document).ready(function(){
        scroll_btn_change();      
    });

    // 画面幅が変更されたときに実行させたい処理内容
    $(window).resize(function(){ 
        scroll_btn_change();        
    });

    function scroll_btn_change(){

        var i = 1;
        while(true){

            var merchandise_area = "#merchandise" + i;
            //商品情報の表示があるかチェック            
            if(!($(merchandise_area).length)){				
                break;							
            }
           
            //各クラスの宣言
            var photo_select_area_class = merchandise_area + " .photo-select-area";
            var sub_photo_class = merchandise_area + " .sub-photo-div";
            var scroll_btn_class = merchandise_area + " .scroll-btn";
            var arrow_area_class = merchandise_area + " .arrow-area .arrow_logo";

            //写真1枚あたりの横幅取得
            var sub_photo_width = $(sub_photo_class).width();

            //写真数取得
            var photo_count = $(sub_photo_class).length;

            //写真幅*写真数で横幅取得
            var all_width = sub_photo_width * photo_count;

            //スクロール可能エリアの横幅取得
            var select_area_width = $(photo_select_area_class).width();
            

            //スクロールボタンとモバイル用矢印を一度不可視
            $(scroll_btn_class).addClass('d-none');
            $(arrow_area_class).addClass('d-none');

            if(select_area_width < all_width){
                //スクロール可能エリアより写真総横幅が超えた場合スクロールボタンとモバイル用矢印可視化
                $(scroll_btn_class).removeClass('d-none');
                $(arrow_area_class).removeClass('d-none');
            }
           
            i++;
        }
  
           
    }


    $(".photo_button").on('click',function(e){
        
        
        var targetpath = $(this).data('targetpath');
        var merchandiseid = $(this).data('merchandiseid');
        var kinds = $(this).data('kinds');
        var file_name = $(this).data('imagename');
        
        

        $('#merchandise'+ merchandiseid + ' .sub-photo').removeClass('select-border');
        $('#merchandise'+ merchandiseid + ' .sub-photo').removeClass('none-select-border');      


        $('#merchandise'+ merchandiseid + ' .sub-photo').addClass('none-select-border');

        $('#merchandise'+ merchandiseid + ' .kinds' + kinds).removeClass('none-select-border');      
        $('#merchandise'+ merchandiseid + ' .kinds' + kinds).addClass('select-border');  
        
        
        
        $('#merchandise'+ merchandiseid + ' .main-photo-area').empty();

        var Element = "";

        Element +="<img id=''class='merchandise-photo' src='" + targetpath + "' alt='" + file_name + "'>";

        
        $('#merchandise'+ merchandiseid + ' .main-photo-area').append(Element);           
       

    });




    $('.scroll-btn').click(function () {

        var merchandiseid = $(this).data('merchandiseid');


        //左右の値(左 = 1 :: 右 = 2)
        var direction = $(this).data('direction');

        var scroll_area = '#merchandise' + merchandiseid + ' .photo-select-area';

        var scroll_range = 250;
       

        if(direction == 1){

            $(scroll_area).animate({
                scrollLeft: $(scroll_area).scrollLeft() - scroll_range //〇〇px左にスクロールする
            }, 300); //スクロールにかかる時間

        }else{

            $(scroll_area).animate({
                scrollLeft: $(scroll_area).scrollLeft() + scroll_range //〇〇px右にスクロールする
            }, 300); //スクロールにかかる時間

        }


    });


</script>


@endsection

