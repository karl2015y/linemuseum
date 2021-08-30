@extends('phone.layout.type2')
@section('title', '我的兌換券-未兌換')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <a href="{{route('MemberVouchersPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    <span class="text-xl font-medium">我的兌換券-未兌換</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

{{-- shops --}}
<div class="px-2 pb-10" style="margin-top:-2px">
    @foreach ($vcrs as $vcr)
        <div class="p-4 border-solid border-t-2 border-gray-300">
            <img class="w-72 h-72 mx-auto object-cover rounded-2xl shadow"
                src="{{$vcr->pic_1}}?t={{rand()}}" alt="">
            <h1 class="my-2 ml-3">【{{$vcr->voucher_name}}】</h1>
            <div class="mb-1 ml-5 font-light text-sm text-gray-400">開始時間 | {{$vcr->start_at}}</div>
            <div class="my-1 ml-5 font-light text-sm text-gray-400">結束時間 | {{$vcr->end_at}}</div>
            <div>
                <a href="{{route('MemberVoucherPage', ['voucher_record_id'=>$vcr->id])}}"
                    class="text-center w-10/12 mx-auto mt-4 py-2 px-6 text-white rounded bg-color-main shadow block md:inline-block">
                    詳 細 資 料
                </a>
                <a href="{{route('MemberUseVoucherPage', ['voucher_record_id'=>$vcr->id])}}"
                    class="text-center w-10/12 mx-auto mt-4 py-2 px-6 text-white rounded bg-color-main shadow block md:inline-block">
                    使用兌換券
                </a>
            </div>
        </div>
        @endforeach


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
</script>
@stop