@extends('phone.layout.type2')
@section('title', '館舍管理')
@section('content')
{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <span class="text-xl font-medium">商｜家｜管｜理</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>
{{-- museum datas--}}
{{-- name --}}
<div class="bg-gray-500 py-8 text-center">
    <h1 class="text-3xl font-bold text-gray-50">{{$shop->name}}</h1>
</div>
{{-- description --}}
<div class="px-6 m-5 pt-1 border-solid border-b pb-12 mb-0">
    <div class="pb-4 text-xl font-medium">商家簡介</div>
    <div class="font-light text-gray-400">
        {!!$shop->description!!}
    </div>
</div>
{{-- datas --}}
<div class="m-10 mb-5">
    {{-- 電話 --}}
    <div class="flex font-light pb-1">
        <span class="pt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
        </span>
        <div class="ml-3 text-xl">{{$shop->phone}}</div>
    </div>
    {{-- 總消費點數 --}}
    <div class="flex font-light pb-1">
        <span class="pt-1.5 pl-0.5">
            <div class="flex justify-center items-center border-solid border-2 rounded-full w-4 h-4">
                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                    </path>
                </svg>
            </div>
        </span>
        <div class="ml-3.5 text-xl">總消費點數｜{{$shop->AllPoint()}} 點</div>
    </div>
    {{-- 總消費金額 --}}
    <div class="flex font-light pb-1">
        <span class="pt-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
        </span>
        <div class="ml-3 text-xl">總消費金額｜{{$shop->AllPrice()}} 元</div>
    </div>
    {{-- 建立人 --}}
    <div class="flex font-light pb-1">
        <span class="pt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </span>
        <span class="ml-3 mt-1.5 text-sm">(建立)</span>
        <div class="text-xl">｜{{$shop->CreatedStaff->name}}</div>
    </div>
    {{-- 建立時間 --}}
    <div class="flex font-light pb-1">
        <span class="pt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </span>
        <span class="ml-3 mt-1.5 text-sm">(建立)</span>
        <div class="text-xl">｜{{$shop->created_at}}</div>
    </div>



</div>
{{-- 給予消費點 --}}
<a href="{{route('ShopGivePointPage')}}">
    <div class="px-12 pt-2">
        <button
            class="w-full py-3 px-6 text-white rounded-lg bg-color-main shadow-lg block md:inline-block">給予消費點</button>
    </div>
</a>
{{-- 消費紀錄 --}}
<a href="{{route('ShopHistoryPage')}}">
    <div class="px-12 pt-3 pb-7 ">
        <button
            class="w-full py-3 px-6 text-white rounded-lg bg-color-main shadow-lg block md:inline-block">消費紀錄</button>
    </div>
</a>
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