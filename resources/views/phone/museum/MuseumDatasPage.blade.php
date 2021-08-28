@extends('phone.layout.type2')
@section('title', '館舍管理')
@section('content')
    {{-- topbar --}}
    <div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
        <span class="text-xl font-medium">館｜舍｜後｜台</span>
    </div>
    <div id="toptitleSpace" class="hidden w-full h-24"></div>
    {{-- museum datas--}}
    {{-- name --}}
    <div class="bg-color-main py-8 text-center">
        <h1 class="text-3xl font-bold text-gray-50">{{$museum->name}}</h1>
    </div>
    {{-- description --}}
    <div class="px-6 m-5 pt-1 border-solid border-b pb-12 mb-0">
        <div class="pb-4 text-xl">館舍簡介</div>
        <div class="font-light text-gray-400">
            {!!$museum->description!!}
        </div>
    </div>
    {{-- datas --}}
    <div class="m-10">
        {{-- 電話 --}}
        <div class="flex font-light pb-1">
            <span class="pt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </span>
            <div class="ml-3 text-xl">{{$museum->phone}}</div>
        </div>
        {{-- 地址 --}}
        <div class="flex font-light pb-1">
            <span class="pt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>
            <div class="ml-3 text-xl">{{$museum->address}}</div>
        </div>
        {{-- 信箱 --}}
        <div class="flex font-light pb-1">
            <span class="pt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
            <div class="ml-3 text-xl">{{$museum->email}}</div>
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
            <div class="text-xl">｜{{$museum->CreatedStaff->name}}</div>
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
            <div class="text-xl">｜{{$museum->created_at}}</div>
        </div>



    </div>
    {{-- 商家列表 --}}
    <a href="{{route('MuseumShopsPage')}}">
        <div class="px-12 py-6">
            <button
                class="w-full py-3 px-6 text-white rounded-lg bg-color-main shadow-lg block md:inline-block">商家列表</button>
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