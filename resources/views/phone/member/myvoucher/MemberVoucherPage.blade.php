@extends('phone.layout.type2')
@section('title', '我的兌換券')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    {{-- 預購券 MemberPrebuyVouchersPage--}}
    @if ($vcr_status=='pre')
    <a href="{{route('MemberPrebuyVouchersPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    @endif
    {{-- 未兌換 MemberCanUseVouchersPage--}}
    @if ($vcr_status=='unused')
    <a href="{{route('MemberCanUseVouchersPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    @endif
    {{-- 已兌換 MemberUsedVouchersPage--}}
    @if ($vcr_status=='used')
    <a href="{{route('MemberUsedVouchersPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    @endif
    {{-- 已過期 MemberPassedVouchersPage--}}
    @if ($vcr_status=='pass')
    <a href="{{route('MemberPassedVouchersPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    @endif

    <span class="text-xl font-medium">{{$vcr->voucher_name}}</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

{{-- shops --}}
<div class="pb-4 px-6 overflow-x-hidden overflow-y-auto">

    <div class="p-4">
        <img class="w-72 h-72 mx-auto object-cover rounded-2xl shadow" src="{{$vcr->pic_1}}?t={{rand()}}" alt="">
        <div class="my-2 flex">
            @if ($vcr_status=='pre')
            <div class="bg-color-third text-white px-1 font">預購</div>
            <h1>【{{$vcr->voucher_name}}】</h1>
            @else
            <h1>【{{$vcr->voucher_name}}】{{$vcr_status=='pass'?'- 已過期':''}}{{$vcr_status=='used'?'- 已兌換':''}}</h1>
            @endif
        </div>

        <div class="mb-1 ml-2 font-light text-sm">開始時間｜<span
                class="text-gray-400">{{$vcr->start_at}}({{$vcr->start_at->diffForHumans()}})</span></div>
        <div class="my-1 ml-2 font-light text-sm">結束時間｜<span
                class="text-gray-400">{{$vcr->end_at}}({{$vcr->end_at->diffForHumans()}})</span></div>
        @if ($vcr_status=='pre')
        <div class="my-1 ml-2 font-light text-sm">當前寄送狀態｜<span class="text-color-third font-bold">
                {{$vcr->PreVoucherRecord->current_status}}</span></div>
        <div class="mt-1 ml-2 font-light text-sm">歷史寄送狀態｜</div>
        <ul class="ml-2 font-light text-sm text-gray-400 pl-2">
            {!! $vcr->PreVoucherRecord->status_list !!}
        </ul>
        @if ($vcr->PreVoucherRecord->current_status=='已寄出')
        <div class="mt-1 ml-2 font-light text-sm">出貨備註｜</div>
        <div class="w-max bg-gray-50 p-5 -ml-4 mt-3">
            {!! $vcr->PreVoucherRecord->member_note !!}
        </div>
        @else
        <div class="mt-1 ml-2 font-light text-sm">收件人資料</div>
        <div class="border-solid border-b border-gray-200 pb-2">
            <div class="my-1 ml-6 font-light text-sm text-gray-400">名稱：
                    {{$vcr->PreVoucherRecord->name}}</div>
            <div class="my-1 ml-6 font-light text-sm text-gray-400">地址：
                    {{$vcr->PreVoucherRecord->address}}</div>
            <div class="my-1 ml-6 font-light text-sm text-gray-400">電話：
                    {{$vcr->PreVoucherRecord->phone}}</div>
            <div class="my-1 ml-6 font-light text-sm text-gray-400">Email：
                    {{$vcr->PreVoucherRecord->email}}</div>
        </div>
        @endif
        @endif
        <div class="mt-1 ml-2 font-light text-sm">兌換券說明｜</div>
        <p class="ml-2 font-light text-sm text-gray-400">
            {!! $vcr->description !!}
        </p>
        @if ($vcr_status=='unused')
        <div>
            <a href="{{route('MemberUseVoucherPage', ['voucher_record_id'=>$vcr->id])}}"
                class="text-center w-10/12 mx-auto mt-4 py-2 px-6 text-white rounded bg-color-main shadow block md:inline-block">
                使用兌換券
            </a>
        </div>
        @endif

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
</script>
@stop