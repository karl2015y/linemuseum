@extends('phone.layout.type2')
@section('title', '我的帳號')
@section('content')
<div id="toptitle" class="relative text-center h-20 bg-color-sec flex items-end">
    {{-- <span class="text-xl font-medium">館｜舍｜後｜台</span> --}}
    <img class="h-1/2 w-auto mx-auto mb-2" src="/asset/img/logo-row.png" alt="row-logo">
    <a class="absolute right-5 bottom-2 text-gray-500" href="{{route('logout')}}">
        <span>登出</span>
    </a>
</div>
<div class="flex flex-col justify-between" style="height: calc(100% - 5rem);">
    <div class="px-8 flex flex-col justify-around h-3/4">
        <div class="text-gray-500 text-xl font-light">
            <div class="mb-1">名稱/暱稱｜{{$member->name}}</div>
            <div class="mb-1">性&emsp;&emsp;別&thinsp;&thinsp;｜{{$member->gender=='male'?'男':'女'}}</div>
            <div class="mb-1">出生年月&thinsp;&thinsp;｜{{$member->year}} 年 {{$member->month}} 月</div>
            <div class="mb-1">居住區域&thinsp;&thinsp;｜{{$member->address_region}}</div>
            <div class="mb-1">電子信箱&thinsp;&thinsp;｜{{$member->email}}</div>
            <div class="mb-1">連絡電話&thinsp;&thinsp;｜{{$member->phone}}</div>
            <div class="mb-1">推薦單位&thinsp;&thinsp;｜{{$member->recommend_museum}}</div>
            <div class="mb-1">註冊時間&thinsp;&thinsp;｜{{$member->created_at}}</div>

        </div>
        <div class="px-6">
            <a href="{{route('EditMemberAccountPage')}}">
                <button
                    class="w-full py-3 px-6 text-white rounded bg-color-main shadow block md:inline-block">編輯個人資料</button>
            </a>
        </div>

    </div>

    <div class="flex justify-around py-2 bg-gray-100">
        <x-Phone.BottomMenu focus="myaccount"/> {{-- mypoint shop myvoucher myaccount --}}
    </div>
</div>

@stop