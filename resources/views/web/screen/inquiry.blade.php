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
    background-color: #f5fdd1;
    font-size: 1.1rem;
}

.qa summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    padding: 1em 1em 1em 3em;
    
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
    padding: .3em 2em 1em 3em;
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


.answer{
    
}


</style>

<div id="main" class="mt-3 container">

    <div class="row">      
        
        <div class="col-12 m-0 ">
            <h3 class="test text-start">
                よくあるご質問
            </h3>                
        </div>

        <div class="col-12 info-box" style="padding: 1vh;">

            @foreach ($question_m as $index => $info)

                <details class="qa">
                                    
                    <summary>                        
                        {!! nl2br($info->question) !!}
                    </summary>

                    <p class="answer">
                        {!! nl2br($info->answer) !!}                        
                    </p>

                </details>

            @endforeach		

            

            <div class="col-12 mt-2 p-0 text-start" style="font-size: 1.2rem;">                
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

