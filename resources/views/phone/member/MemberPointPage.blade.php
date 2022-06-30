@extends('phone.layout.type2')
@section('title', '我的點數')
@section('content')
<div id="toptitle" class="relative text-center h-20 bg-color-sec flex items-end">
    {{-- <span class="text-xl font-medium">館｜舍｜後｜台</span> --}}
    <img class="h-1/2 w-auto mx-auto mb-2" src="/asset/img/logo-row.png" alt="row-logo">
</div>
<div class="flex flex-col justify-between" style="height: calc(100% - 5rem);">
    <div class="px-4 pb-4">
        <a class="hidden" href="{{route('MemberPayHistoryPage')}}">
            <div class="mt-4 text-center text-xl font-medium text-white"
                style="max-height: 200px;height: 55vw;min-height: 176px;min-width: 288px;background-image: url(/asset/img/pay-point-card.jpg);background-size: contain;background-repeat: no-repeat;background-position: center;">
                <div class="py-2">消費點</div>
                <div class="pt-8 flex justify-center items-end">
                    <span class="mr-3 ml-8 text-5xl font-extrabold text-color-third">{{$member->pay_point}}</span>
                    <div class="text-gray-400">點</div>
                </div>
            </div>
        </a>

        <a href="{{route('MemberKAHistoryPage')}}">
            <div class="mt-4 text-center text-xl font-medium text-white"
                style="max-height: 200px;height: 55vw;min-height: 176px;min-width: 288px;background-image: url(/asset/img/ka-point-card.jpg);background-size: contain;background-repeat: no-repeat;background-position: center;">
                <div class="py-2">知識點</div>
                <div class="pt-8 flex justify-center items-end">
                    <span class="mr-3 ml-8 text-5xl font-extrabold text-color-third">{{$member->knowledge_point}}</span>
                    <div class="text-gray-400">點</div>
                </div>
            </div>
        </a>

    </div>

    <div class="flex justify-around py-2 bg-gray-100">
        <x-Phone.BottomMenu focus="mypoint"/> {{-- mypoint shop myvoucher myaccount --}}
    </div>
</div>

@stop