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

<div class="flex flex-col justify-between" style="height: calc(100% - 10rem);">
    <div class="flex flex-col justify-around h-full">
        <img class="w-full h-full object-cover" src="{{$vcr->Pic_2}}?t={{rand()}}" alt="">
    </div>

    <div class="flex justify-around py-6 h-20 text-3xl bg-color-third text-white">
        <button onclick="modelToggle()" class="w-full h-full">兌&emsp;換</button>
    </div>
</div>
@stop


@section('model-content')
<div id="model-content" class="overflow-hidden bg-white w-10/12 h-1/3 rounded-2xl p-4 shadow-2xl"
    style="min-height: 280px;">

        <div class="h-full flex flex-col justify-between">
            <div id="model-text" class="pt-8 px-6 text-xl text-gray-400 font-light">
                <h1 class="font-bold text-2xl text-black mb-6">是否確定使用兌換?</h1>
                是否確認兌換<br>(不要自己在家按喔^ _ ^)
            </div>
            <div class="flex justify-around text-2xl font-medium">
                <div class="w-1/2 text-center border-r border-solid border-gray-300">
                    <form action="{{route('MemberUseVoucher', ['voucher_record_id'=>$vcr->id])}}" method="post"> 
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

</script>
@stop