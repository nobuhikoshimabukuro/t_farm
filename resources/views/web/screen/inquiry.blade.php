@extends('web.common.layouts_app')

@section('pagehead')
@section('title', 'お問い合わせ')  

@endsection
@section('content')

<style>

/* Q&A  start */
.qa {
    /* max-width: 500px; */
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 4px rgb(0 0 0 / 2%), 0 2px 3px -2px rgba(0 0 0 / 5%);
    background-color: #f4ebf5;
    font-size: 1.1rem;
}

.qa summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    padding: 1em 2em 1em 3em;
    color: #333333;
    font-weight: 600;
    cursor: pointer;
}

.qa summary::before,
.qa p::before {
    position: absolute;
    left: 1em;
    font-weight: 600;
    font-size: 1.3em;
}

.qa summary::before {
    color: #75bbff;
    content: "Q";
}

.qa summary::after {
    transform: translateY(-25%) rotate(45deg);
    width: 7px;
    height: 7px;
    margin-left: 10px;
    border-bottom: 3px solid #333333b3;
    border-right: 3px solid #333333b3;
    content: '';
    transition: transform .5s;
}

.qa[open] summary::after {
    transform: rotate(225deg);
}

.qa p {
    position: relative;
    transform: translateY(-10px);
    opacity: 0;
    margin: 0;
    padding: .3em 3em 1.5em;
    color: #333;
    transition: transform .5s, opacity .5s;
}

.qa[open] p {
    transform: none;
    opacity: 1;
}

.qa p::before {
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

                <details class="qa">
                                    
                    <summary>                        
                        {!! nl2br($info->question) !!}
                    </summary>

                    <p>
                        {!! nl2br($info->answer) !!}                        
                    </p>

                </details>

            @endforeach		

            

            <div class="col-12 mt-1 p-0 text-start" style="font-size: 1.1rem;">                
                <p>
                    他にご質問などがあればお気軽にご連絡ください。   
                    販売サイト（BASE）の<a href="{{ env('base_inquiry_url') }}" class="underline" target="_blank">お問い合わせページ</a>にて承っております。                    
                </p>
            </div>
         
        </div>       

    </div>


    
    
</div>









@endsection

@section('pagejs')

<script type="text/javascript">

</script>


@endsection

