@extends('web.common.layouts_app')

@section('pagehead')
@section('title', 'ククナマンゴーテスト')  

@endsection
@section('content')

<style>


.contents{
  margin: 1vh 0;
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
   overflow-x:auto;     
   /* overflow-x:none;     */
}

.photo-select-scroll-area{   
    object-fit: contain;
    display: flex; 
    /* justify-content: center; */
}




/* 参考サイト
https://junpei-sugiyama.com/swiper-summary/
*/

.swiper-slide {
  overflow: hidden;
  position: relative;
}

.swiper-img{
  height: 100%;
}
.swiper-slide img {
  height: 100%;
  width: 100%;
}

.swiper-text {
  color: #fff;  
  text-shadow: 1px 1px 2px #333;  
  width: 70%;
  position: absolute;
  width: 70%;
}

.swiper-text-position1 {
  top: 5%;
  left: 5%;  
}

.swiper-text-position2 {
  top: 5%;
  right: 5%;  
}

.swiper-text-position3 {
  bottom: 5%;
  left: 5%;  
}

.swiper-text-position4 {
  bottom: 5%;
  right: 5%;  
}

.swiper-title {
  font-size: clamp(16px, 3vw, 50px);
  font-weight: 700;
}
.swiper-desc {
  font-size: clamp(12px, 2vw, 30px);
  line-height: 1.5;
  margin-top: 3%;
}


.swiper-button{
  color: #fff;  
  text-shadow: 1px 1px 1px #333;  
  font-weight: 400;
}

/* PC用 */
@media (min-width: 768px) {

.greeting p{  
  font-size: 20px;  
  font-weight: 500;
}


}

/* モバイル用 */
@media (max-width: 768px) {

  .greeting p{  
    font-size: 18px;  
  }

}


</style>

<div class="swiper">

  <div class="swiper-wrapper">




    <div class="swiper-slide">

      <div class="swiper-img" data-swiper-parallax-x="90%">
        <img class="image" src="{{ asset('img/top/0001.jpg') }}">    
      </div>

      <div class="swiper-text swiper-text-position1">
        <h3 class="swiper-title">沖縄の自然の力を借りて<br>おいしいマンゴーを</h3>
        <p class="swiper-desc" data-swiper-parallax-x="70%">          
        </p>
      </div>

    </div>


    <div class="swiper-slide">
      
      <div class="swiper-img" data-swiper-parallax-x="90%">
        <img class="image" src="{{ asset('img/top/0002.jpg') }}">    
      </div>

      <div class="swiper-text swiper-text-position3">
        <h3 class="swiper-title">南国の太陽を浴びてより</h3>
        <p class="swiper-desc" data-swiper-parallax-x="70%">
          説明2
        </p>
      </div>

    </div>
   

    <div class="swiper-slide">
      
      <div class="swiper-img" data-swiper-parallax-x="90%">
        <img class="image" src="{{ asset('img/top/0003.jpg') }}">    
      </div>

      <div class="swiper-text swiper-text-position1">
        <h3 class="swiper-title">タイトル3</h3>
        <p class="swiper-desc" data-swiper-parallax-x="70%">
          説明3
        </p>
      </div>

    </div>

    <div class="swiper-slide">
      
      <div class="swiper-img" data-swiper-parallax-x="90%">
        <img class="image" src="{{ asset('img/top/1000.jpg') }}">    
      </div>
      
      <div class="swiper-text swiper-text-position3">
        <h3 class="swiper-title">タイトル4</h3>
        <p class="swiper-desc" data-swiper-parallax-x="70%">
          説明4
        </p>
      </div>

    </div>




  </div>
  <!-- ページネーション -->
  <div class="swiper-pagination"></div>
  <!-- 前後の矢印 -->
  <div class="swiper-button swiper-button-prev"></div>
  <div class="swiper-button swiper-button-next"></div>
</div>



<div class="mt-3 text-center container">

  
  <div class="contents row p-0">
    {{-- <img src="{{ asset('img/top/1000.jpg') }}" class="p-0 m-0"> --}}

    <div id="" class="col-12 m-0 p-0">

      <div id="" class="title">
        <h4 class="p-0 text-start">ご挨拶</h4>
      </div> 

      <div id="" class="greeting">

        <p class="text-start">
          こんにちは!!沖縄県宜野座村でマンゴー農家を営んでいるたかすじファームと申します。       
          <br>
          私たちの農園で丹精込めて育てたマンゴーは、豊かな自然と愛情に包まれ、一つひとつ丁寧に収穫しています。
          <br>
          ご自身で楽しむために、瑞々しくて甘いマンゴーを味わってみてください。
          さらに、大切な方への贈り物としても喜ばれること間違いなしです。
          <br>
          特別な瞬間を彩る一品として、私たちのマンゴーをお選びいただければ幸いです。
          <br>
          ご注文は簡単で、全国配送も承っております。ぜひこの機会に、当農園自慢のマンゴーをご堪能ください。
          <br>          
          <span class="emphasis item-flash">
            2024年分の販売予約を開始しました。
            
            詳細はInstagramをチェックしてください。
          </span>
          <br>
          商品の詳細は<a href="{{ route('web.merchandise') }}" class="underline">商品紹介ページ</a>でご覧ください。          
          <br>
          不定期ではございますが、<a href="{{env('instagram_url') }}" class="underline" target="_blank">Instagram</a>で沖縄や農園の最新情報を発信しております。
          <br>
          ぜひチェックして、私たちの取り組みをフォローしてください。
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


document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper(".swiper", {
            loop: true, // ループ
            speed: 1800, // 少しゆっくり(デフォルトは300)
            slidesPerView: 1, // 一度に表示する枚数
            spaceBetween: 0, // スライド間の距離
            centeredSlides: true, // アクティブなスライドを中央にする
            autoplay: {
                delay: 6000, // 6秒後に次のスライド                
                disableOnInteraction: false, // 矢印をクリックしても自動再生を止めない
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints:{       
                768: {
                    slidesPerView: 1.2,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 1.3,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 1.5,
                    spaceBetween: 30,
                }
            },
            on: {
                init: adjustSwiperHeight,
                resize: adjustSwiperHeight,
                slideChange: adjustSwiperHeight // スライドが変更されたときに高さを調整
            }
        });

        function adjustSwiperHeight() {
            var swiperSlide = document.querySelector('.swiper-slide');
            if (swiperSlide) {
                var slideWidth = swiperSlide.offsetWidth;
                var swiperContainer = document.querySelector('.swiper');
                var goldenRatio = 1.618;
                swiperContainer.style.height = (slideWidth / goldenRatio) + 'px';
            }
        }

        // 初期ロード時に高さを調整
        adjustSwiperHeight();

        // ウィンドウのリサイズ時に高さを調整
        window.addEventListener('resize', adjustSwiperHeight);
    });



// const swiper = new Swiper(".swiper", {
//   loop: true, // ループ
//   speed: 1500, // 少しゆっくり(デフォルトは300)
//   slidesPerView: 1, // 一度に表示する枚数
//   spaceBetween: 30, // スライド間の距離
//   centeredSlides: true, // アクティブなスライドを中央にする
//   autoplay: {
//     // 自動再生
//     delay: 80000, // 1秒後に次のスライド
//     disableOnInteraction: false, // 矢印をクリックしても自動再生を止めない
//   },
//   // ページネーション
//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//   },
//   // 前後の矢印
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
//   breakpoints:{
   
//     768:{
//       slidesPerView: 1.2,
//     }
//   }
// });



</script>


@endsection

