@extends('web.common.layouts_app')

@section('pagehead')
@section('title', 'たかすじファーム')  

@endsection
@section('content')

<style>


.contents{
  margin: 1vh 0;
}

.top-page-phot-area {
  position: relative;  
  width: 100%;    
}

.image {
  top:0;
  left: 0;
  position: absolute;  
  width: 100%;
  height: 100%;
  opacity: 0;
  animation: change-img-anim 30s infinite;
}

.image:nth-of-type(1) {
  animation-delay: 0s;
}
.image:nth-of-type(2) {
  animation-delay: 10s;
}
.image:nth-of-type(3) {
  animation-delay: 20s;
}

@keyframes change-img-anim {
  0%{ opacity: 0;}
  10%{ opacity: 1;}
  90%{ opacity: 1;}
  100%{ opacity: 0;}
}



.vertical {
  writing-mode: vertical-rl;  
  background-color: rgba(245, 195, 230, 0.4);
  color: rgb(39, 30, 7);
  font-weight: 600;
}

.text-1 {
  position: absolute;    
}

.text-2 {
  position: absolute; 
}

.text-3 {
  position: absolute;  
}

/* PC用 */
@media (min-width: 768px) {

  .top-page-phot-area { 
    height: 70vh;
  }

  .vertical {    
    font-size: 40px;      
  }

  .text-1 {    
    top: 20px;
    right: 90px;
  }

  .text-2 {    
    top: 80px;
    right: 160px;
  }

  .text-3 {    
    top: 140px;
    right: 230px;
  }


  .greeting p{  
    font-size: 20px;  
    font-weight: 500;
  }


}

/* モバイル用 */
@media (max-width: 768px) {

  .top-page-phot-area {
    height: 50vh;
  }

  .vertical {    
    font-size: 25px;
  }

  .text-1 {    
    top: 10px;
    right: 10px;
  }

  .text-2 {    
    top: 50px;
    right: 50px;
  }

  .text-3 {    
    top: 90px;
    right: 90px;
  }

  .greeting p{  
    font-size: 18px;  
  }

}


/* .title{
  border-top: 1px solid #333;
  border-bottom: 1px solid #333;
} */

.contents h4{
  margin: 0 5px;
}


.greeting{
  padding: 1vh;
  background-color: rgba(250, 247, 249, 0.7);
  height: 100%;
}

.greeting p{  
  font-size: 20px;
  color: #250f12;
  /* font-family:"ヒラギノ丸ゴ Pro W4","ヒラギノ丸ゴ Pro","Hiragino Maru Gothic Pro","ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","HG丸ｺﾞｼｯｸM-PRO","HGMaruGothicMPRO"; */
}


.title{
  padding-top: 1px;
  padding-bottom: 1px;
  font-weight: bold;
  font-size: 16px;
  position: relative;
  text-align: left;
}
.title::before{
  content: '';
  position: absolute;
  bottom: -3px;
  width: 100%;
  height: 3px;
  background: linear-gradient(
    to right, 
    #f98469 0%, #f98469 25%, /*ピンク*/
    #ffd12a 25%, #ffd12a 50%, /*黄色*/
    #a4de32 50%, #a4de32 75%, /*緑*/
    #91c0f1 75%, #91c0f1 100% /*青*/
  );
}

.underline{
  border-bottom: dotted 2px blue;
}



.photo-select-area{   
   overflow-x:scroll;     
   /* overflow-x:none;     */
}

.photo-select-scroll-area{   
    object-fit: contain;
    display: flex; 
    /* justify-content: center; */
}



</style>

  {{-- スマホ --}}
  {{-- <div class="d-block d-md-none w-100">
    <div class="row p-0 m-0">
      <img src="{{ asset('img/top/0001.jpg') }}" class="p-0 m-0">
    </div>   
  </div>    --}}

  {{-- PC --}}
  {{-- <div class="d-none d-md-block w-100">
    <div class="row p-0 m-0">
      <img src="{{ asset('img/top/0001.jpg') }}" class="p-0 m-0">
    </div>   
  </div>    --}}



  

  

    



<div class="mt-3 text-center container">

  <div class="contents row p-0">

    <div class="col-12 m-0 p-0">
      
      <div class="top-page-phot-area">

        {{-- PC --}}
        <div class="wide d-none d-md-block w-100">

        </div> 

        {{-- スマホ --}}
        <div class="d-block d-md-none w-100">

        </div> 
        <img class="image" src="{{ asset('img/top/0001.jpg') }}">        
        <img class="image" src="{{ asset('img/top/0003.jpg') }}">
        <img class="image" src="{{ asset('img/top/0002.jpg') }}">


        <div class="text-area text-1">
          {{-- <p class="vertical">沖縄の自然の恵みから生まれた最高のマンゴー</p>       --}}
          <p class="vertical">沖縄の自然の</p>          
        </div> 

        <div class="text-area text-2">
          <p class="vertical">恵みから生まれた</p>
        </div> 

        <div class="text-area text-3">
          <p class="vertical">最高のマンゴー</p>
        </div> 
        
     
        
      </div>  

    </div>  


  </div> 

  
  <div class="contents row p-0">
    {{-- <img src="{{ asset('img/top/1000.jpg') }}" class="p-0 m-0"> --}}

    <div id="" class="col-12 m-0 p-0">

      <div id="" class="title">
        <h4 class="p-0 text-start">ご挨拶</h4>
      </div> 

      <div id="" class="greeting">

        <p class="text-start">
          こんにちは!!沖縄県宜野座村でマンゴー農家を営んでいるたかすじファームと申します。
          沖縄の自然の力を借り、1つ1つ大切に栽培しております。
          お客様にご満足いただける、安心で美味しいマンゴーをお届けいたします。
          <br>
          栽培しているマンゴーは<a href="{{ route('web.merchandise') }}" class="underline">商品紹介ページ</a>でご覧ください。
          <br>
          <br>
          皆様に直接購入して頂けるよう<a href="{{env('base_url') }}" class="underline" target="_blank">インターネット販売（BASE）</a>を行っております。
          <br>          
          <span class="emphasis item-flash">2023年の収穫分は多くのお客様からのご好評によりは完売致しました。
          <br>
          誠にありがとうございました。</span>
          <br>
          また来年の夏にお客様を笑顔にできるようご準備致しますので、
          どうぞ宜しくお願い致します。
          <br>
          公式LINEで販売開始等のお知らせを行っております。ご興味がありましたらお友達になってください。
          <br>
          また不定期ではございますが各SNSで沖縄や農園情報を発信しております。
        </p>


      </div>

    </div> 


    <div id="" class="col-12 m-0 p-0">
      <div id="" class="title">
        <h4 class="p-0 text-start">Instagram</h4>
      </div> 

      <div id="" class="row m-0 p-0">


        <div class="photo-select-area m-0 p-0">

          <div class="photo-select-scroll-area m-0 p-0">

              
              @foreach ($instagram_t as $index => $info)

                <div id="" class="m-1 p-0">
                  <h3>
                    {{$info->title}}
                  </h3>
                  {!! $info->embedded_characters !!}
                </div>   

              @endforeach		
          

          </div>                        

        </div>
            
         
      </div>

    </div>

  </div> 

    

  


</div>









@endsection

@section('pagejs')

<script type="text/javascript">

</script>


@endsection

