@extends('phone.layout.type2')
@section('title', '我的點數')
@section('content')
<div id="toptitle" class="relative text-center h-20 bg-color-sec flex items-end">
    {{-- <span class="text-xl font-medium">館｜舍｜後｜台</span> --}}
    <img class="h-1/2 w-auto mx-auto mb-2" src="/asset/img/logo-row.png" alt="row-logo">
</div>
<div class="flex flex-col justify-between" style="height: calc(100% - 5rem);">
    <div class=" flex flex-col overflow-auto">
        {{-- 未兌換 MemberCanUseVouchersPage--}}
        <a href="{{route('MemberCanUseVouchersPage')}}">
            <div class="relative">
                <h2 class="absolute top-1/2 left-1/2 text-4xl -ml-16 -mt-5 font-medium text-white">未 兌 換</h2>
                @if ($unused_vcrs_count>0)
                <div style="width: 2rem;height: 2rem;" class="text-center absolute top-1/4 right-1/4 rounded-full leading-7 bg-color-third text-white font-medium -mt-1 -mr-1">
                    <span style="line-height: 2rem;">{{$unused_vcrs_count}}</span>
                </div>
                @endif
                <img class="mt-2 w-10/12 h-auto mx-auto" src="/asset/img/voucher.jpg" alt="未兌換">
            </div>
        </a>
        {{-- 預購券 MemberPrebuyVouchersPage--}}
        <a href="{{route('MemberPrebuyVouchersPage')}}">
            <div class="relative">
                <h2 class="absolute top-1/2 left-1/2 text-4xl -ml-16 -mt-5 font-medium text-white">預 購 券</h2>
                @if ($prebuy_vcrs_count>0)
                <div style="width: 2rem;height: 2rem;" class="text-center absolute top-1/4 right-1/4 rounded-full leading-7 bg-color-third text-white font-medium -mt-1 -mr-1">
                    <span>{{$prebuy_vcrs_count}}</span>
                </div>
                @endif
                <img class="mt-2 w-10/12 h-auto mx-auto" src="/asset/img/voucher.jpg" alt="預購券">
            </div>
        </a>
        {{-- 已兌換 MemberUsedVouchersPage--}}
        <a href="{{route('MemberUsedVouchersPage')}}">
            <div class="relative">
                <h2 class="absolute top-1/2 left-1/2 text-4xl -ml-16 -mt-5 font-medium text-white">已 兌 換</h2>
                {{-- @if ($used_vcrs_count>0)
                <div style="min-width: 10px;min-height: 10px;max-width: 33px;max-height: 33px;width: 8vw;height: 8vw;" class="absolute top-1/4 right-1/4 rounded-full flex justify-center items-center bg-color-third text-white font-medium -mt-1 -mr-1">
                    {{$used_vcrs_count}}
                </div>
                @endif --}}
                <img class="mt-2 w-10/12 h-auto mx-auto" src="/asset/img/voucher.jpg" alt="已兌換">
            </div>
        </a>
        {{-- 已過期 MemberPassedVouchersPage--}}
        <a href="{{route('MemberPassedVouchersPage')}}">
            <div class="relative">
                <h2 class="absolute top-1/2 left-1/2 text-4xl -ml-16 -mt-5 font-medium text-white">已 過 期</h2>
                {{-- @if ($pass_vcrs_count>0)
                <div style="min-width: 10px;min-height: 10px;max-width: 33px;max-height: 33px;width: 8vw;height: 8vw;" class="absolute top-1/4 right-1/4 rounded-full flex justify-center items-center bg-color-third text-white font-medium -mt-1 -mr-1">
                    {{$pass_vcrs_count}}
                </div>
                @endif --}}
                <img class="mt-2 w-10/12 h-auto mx-auto" src="/asset/img/voucher.jpg" alt="已過期">
            </div>
        </a>



    </div>

    <div class="flex justify-around py-2 bg-gray-100">
        <x-Phone.BottomMenu focus="myvoucher"/> {{-- mypoint shop myvoucher myaccount --}}
    </div>
</div>

@stop