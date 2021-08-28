@extends('phone.layout.type2')
@section('title', '商家消費紀錄列表')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <a href="{{route('MemberPointPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    <span class="text-xl font-medium">消費點紀錄</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>
{{-- shops --}}
<div class="bg-gray-200 p-2 pb-10" style="min-height: calc(100% - 5.25rem);">
    {{ $PPRs->links() }}
    @foreach ($PPRs as $PPR)
    <div class="px-4 py-6 bg-white rounded shadow flex  items-center my-1">
        <div class="pl-4 text-sm font-light">
            <div>館舍名稱｜{{$PPR->shop->museum->name}}</div>
            <div>商家名稱｜{{$PPR->shop_name}}</div>
            <div>消費金額｜{{$PPR->price}} 元</div>
            <div>獲得點數｜{{$PPR->point}} 點</div>
            <div>消費時間｜{{$PPR->created_at}}</div>
        </div>
    </div>  
    @endforeach
    <br>
    {{ $PPRs->links() }}
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