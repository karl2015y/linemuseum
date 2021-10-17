@extends('phone.layout.type2')
@section('title', '兌換卷商店')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <a href="{{route('VouchersStorePage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    <span class="text-xl font-medium">兌換卷商店</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

{{-- shops --}}
<div class="pb-4 px-6 overflow-x-hidden overflow-y-auto">

    <div class="p-4">
        <img class="w-72 h-72 mx-auto object-cover rounded-2xl shadow"
            src="{{$voucher->pic_1}}?t={{rand()}}" alt="">
        <div class="my-2 flex" >
            @if ($voucher->type=='pre')
                <div class="bg-color-third text-white px-1 font">預購</div>
            @endif
            <h1>【{{$voucher->name}}】</h1>
        </div>
        <div class="my-1 ml-2 font-light text-sm text-color-third">剩餘數量｜<span class="text-2xl font-mono">{{$voucher->amount}}</span> 張
        </div>
        <div class="mb-1 ml-2 font-light text-sm">開始時間｜<span class="text-gray-400">{{$voucher->start_at}}({{$voucher->start_at->diffForHumans()}})</span></div>
        <div class="my-1 ml-2 font-light text-sm">結束時間｜<span class="text-gray-400">{{$voucher->end_at}}({{$voucher->end_at->diffForHumans()}})</span></div>
        <div class="mt-1 ml-2 font-light text-sm">兌換券說明｜</div>
        <p class="ml-2 font-light text-sm text-gray-400">
            {!! $voucher->description !!}
        </p>
        <div>
            @foreach ($voucher->VoucherWay as $vw)
                @if ($vw->can_buy)
                    @if ($voucher->type=='pre')
                        <button onclick="buyPreVoucher('{{route('BuyPreVoucherPage',['voucher_id'=>$voucher->id, 'voucher_way_id'=> $vw->id])}}')"
                            class="w-10/12 mx-auto mt-4 py-2 px-6 text-white rounded bg-color-main shadow-md block md:inline-block">
                            使用「{{$vw->text}}」預購
                        </button>
                    @else
                        <button onclick="buyVoucher('{{$vw->text}}', '{{route('BuyVoucher',['voucher_id'=>$voucher->id, 'voucher_way_id'=> $vw->id])}}')"
                            class="w-10/12 mx-auto mt-4 py-2 px-6 text-white rounded bg-color-main shadow-md block md:inline-block">
                            {{$vw->text}}
                        </button>
                    @endif
                    
                @else
                    <button class="w-10/12 mx-auto mt-4 py-2 px-6 text-white rounded bg-gray-300 shadow-inner block md:inline-block">
                        {{$vw->text}} (點數不足)
                    </button>
                @endif
            @endforeach
          
 
        </div>
    </div>



</div>
@stop


@section('model-content')
<div id="model-content" class="overflow-hidden bg-white w-10/12 h-1/3 rounded-2xl p-4 shadow-2xl"
    style="min-height: 280px;">

        <div class="h-full flex flex-col justify-between">
            <div id="model-text" class="pt-8 px-6 text-xl text-gray-400 font-light">
            </div>
            <div class="flex justify-around text-2xl font-medium">
                <div class="w-1/2 text-center border-r border-solid border-gray-300">
                    <form action="" method="post"> 
                        @csrf
                        <button class="w-full h-full" >是</button>
                    </form>
                </div>
                <button class="w-1/2 text-center border-l border-solid border-gray-300" onclick="modelToggle()">否</button>
            </div>      
        </div>

</div>
@stop


@section('js-content')
<script>
    const _scrolldiv = document.querySelector("#scrolldiv")
const _toptitle = document.querySelector("#toptitle")
const _toptitleSpace = document.querySelector("#toptitleSpace")
_scrolldiv.addEventListener('scroll',(e)=>{
    if(_scrolldiv.scrollTop>=_toptitle.clientHeight/2){
        _toptitle.className = "bg-color-sec fixed py-2 shadow text-center top-0 w-full"
        _toptitleSpace.classList.remove('hidden')
    }else{
        _toptitle.className = "relative text-center  pb-2 pt-12 bg-color-sec"
        _toptitleSpace.classList.add('hidden')
    }
})

const buyVoucher = (text, url)=>{
    document.querySelector("#model-content #model-text").innerText = `是否使用${text}購買本券?`
    document.querySelector("#model-content form").action = url
    modelToggle()
}


const buyPreVoucher = (url)=>{
    location.href=url
}
</script>
@stop