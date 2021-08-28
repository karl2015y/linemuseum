@extends('phone.layout.type2')
@section('title', '我的點數')
@section('content')
<div id="toptitle" class="relative text-center h-20 bg-color-sec flex items-end">
    {{-- <span class="text-xl font-medium">館｜舍｜後｜台</span> --}}
    <img class="h-1/2 w-auto mx-auto mb-2" src="/asset/img/logo-row.png" alt="row-logo">
</div>
<div class="flex flex-col justify-between" style="height: calc(100% - 5rem);">
    <div class=" flex flex-col h-4/5 overflow-hidden">
        {{-- 未兌換 MemberCanUseVouchersPage--}}
        <a href="{{route('MemberCanUseVouchersPage')}}">
            <img class="mt-2 w-10/12 h-auto mx-auto" src="/asset/img/cancel.png" alt="未兌換">
        </a>
        {{-- 已兌換 MemberUsedVouchersPage--}}
        <a href="{{route('MemberUsedVouchersPage')}}">
            <img class="mt-2 w-10/12 h-auto mx-auto" src="/asset/img/used.png" alt="已兌換">
        </a>
        {{-- 已過期 MemberPassedVouchersPage--}}
        <a href="{{route('MemberPassedVouchersPage')}}">
            <img class="my-2 w-10/12 h-auto mx-auto" src="/asset/img/passed.png" alt="已過期">
        </a>


    </div>

    <div class="flex justify-around py-2 bg-gray-100">
        <x-Phone.BottomMenu focus="myvoucher"/> {{-- mypoint shop myvoucher myaccount --}}
    </div>
</div>

@stop