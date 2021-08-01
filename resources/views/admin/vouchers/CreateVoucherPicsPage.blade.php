@extends('admin.layouts.type1')

@section('classification-name', '兌換券管理')
@section('title', '新增兌換券頁')




@section('content')



<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('VouchersPage')}}" class="no-underline text-blue-600">兌換券列表頁</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">新增{{$voucher->name}}兌換圖片頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        @if($model=='create')
        <a href="{{route('CreateBuyVoucherWayPage',['voucher_id'=>$voucher->id])}}">
            <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                下一步，新增購買方式
            </button>
        </a>
        <a href="{{route('VouchersPage')}}">
            <button class="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-2 rounded">
                取消
            </button>
        </a>
        @else
        <a href="{{route('VucherPage',['voucher_id'=>$voucher->id])}}">
            <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                完成
            </button>
        </a>
        @endif


    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-2  gap-4">

    <div>
        <div class="pl-2.5 text-gray-500 ">小圖(350 x 350) <span class="text-red-500 font-bold">*</span></div>
        <iframe class="mx-auto" scrolling="no" width="400" height="355"
            src="{{route('picuploadPage',['w'=>"350px", 'h'=>"350px", 'path'=>"vouchers/{$voucher->id}", 'filename'=>"pic1" ] )}}"
            frameborder="0"></iframe>
    </div>

    <div>
        <div class="pl-2.5 text-gray-500 ">大圖(350 x 790) <span class="text-red-500 font-bold">*</span></div>
        <iframe class="mx-auto" scrolling="no" width="400" height="795"
            src="{{route('picuploadPage',['w'=>"350px", 'h'=>"790px", 'path'=>"vouchers/{$voucher->id}", 'filename'=>"pic2"])}}"
            frameborder="0"></iframe>
    </div>
</div>








@stop


@section('JS-content')







@stop