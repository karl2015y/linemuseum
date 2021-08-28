@extends('phone.layout.type2')
@section('title', '商家列表')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <a href="{{route('MuseumDatasPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    <span class="text-xl font-medium ">商家列表</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

{{-- shops --}}
<div class="bg-gray-200 p-2 pb-10 ">
    @foreach ($shops as $shop )
            {{-- shop item --}}
    <a href="{{route('MuseumShopDatasPage',['shop_id'=>$shop->id])}}">
        <div class="bg-white px-6 py-8 rounded shadow flex justify-between items-center mb-2">
            <div>
                <h1 class="font-medium ">{{$shop->name}}</h1>
                <small class="text-gray-400">建立時間｜{{$shop->created_at}}</small>
            </div>
            <div class="text-color-main">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    </a>
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