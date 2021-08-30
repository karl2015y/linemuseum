@extends('phone.layout.type2')
@section('title', '兌換券兌換頁')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-1 pt-12 bg-color-sec">
    <a href="{{route('MemberVouchersPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    <span class="text-xl font-medium">兌換券兌換頁</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

<div class="flex flex-col justify-between" style="height: calc(100% - 8.4rem);">
    <div class="flex flex-col justify-around h-full">
        <img class="w-full h-full object-cover" src="{{$vcr->Pic_2}}?t={{rand()}}" alt="">
    </div>

    <div id="time" class="flex justify-center items-center py-2 h-20 text-3xl bg-color-third text-white">
        0:59
    </div>
</div>
@stop






@section('js-content')
<script>
let time = 60
let x = setInterval(() => {
    time--;
    document.querySelector("#time").innerText = `0:${time.toString().padStart(2,'0')}`
    if(time<0){
        clearInterval(x);
        document.querySelector("#time").innerText = "兌換時間結束"
    }
}, 1000);
</script>
@stop