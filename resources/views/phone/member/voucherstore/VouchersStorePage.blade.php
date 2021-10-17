@extends('phone.layout.type2')
@section('title', '兌換卷商店')
@section('content')
<div id="toptitle" class="relative text-center h-20 bg-color-sec flex items-end">
    {{-- <span class="text-xl font-medium">館｜舍｜後｜台</span> --}}
    <img class="h-1/2 w-auto mx-auto mb-2" src="/asset/img/logo-row.png" alt="row-logo">
</div>
<div class="flex flex-col justify-between" style="height: calc(100% - 5rem);">
    <div class="pb-4 px-6 overflow-x-hidden overflow-y-auto" style="margin-top:-2px">
        @foreach ($vouchers as $voucher)
            <a href="{{route('VoucherStorePage', ['voucher_id'=>$voucher->id])}}">
                <div class="p-4 border-solid border-t-2 border-gray-300">
                    <img class="w-72 h-72 mx-auto object-cover rounded-2xl shadow" src="{{$voucher->pic_1}}?t={{rand()}}" alt="">
                    <div class="my-2 flex" >
                        @if ($voucher->type=='pre')
                            <div class="bg-color-third text-white px-1 font">預購</div>
                        @endif
                        <h1>【{{$voucher->name}}】</h1>
                    </div>
                    <div class="my-1 ml-2 font-light text-sm text-color-third">剩餘數量 | <span class="text-2xl font-mono">{{$voucher->amount}}</span> 張</div>
                    <div class="mb-1 ml-2 font-light text-sm text-gray-400">開始時間 | {{$voucher->start_at}}({{$voucher->start_at->diffForHumans()}})</div>
                    <div class="my-1 ml-2 font-light text-sm text-gray-400">結束時間 | {{$voucher->end_at}}({{$voucher->end_at->diffForHumans()}})</div>
                    <div >
                        <button
                            class="w-10/12 mx-auto mt-4 py-2 px-6 text-white rounded bg-color-main shadow block md:inline-block">詳 細 資 料</button>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="flex justify-around py-2 bg-gray-100">   
         <x-Phone.BottomMenu focus="shop"/> {{-- mypoint shop myvoucher myaccount --}}
    </div>
</div>

@stop