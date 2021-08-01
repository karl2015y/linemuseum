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
            <li><a href="{{route('VucherPage',['voucher_id'=>$voucher->id])}}" class="no-underline text-blue-600">{{$voucher->name}}</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">新增兌換券購買方式頁</li>


            
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
            新增兌換券
        </button>
        <a href="{{route('VucherPage',['voucher_id'=>$voucher->id])}}">
            <button class="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-2 rounded">
                取消
            </button>
        </a>
       
    </div>
</div>



<form action="{{route('CreateBuyVoucherWay',['voucher_id'=>$voucher->id])}}" method="post">
    @csrf

    {{-- 消費點 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="pay_point" name="pay_point" value="{{ old('pay_point') }}" type="number" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="pay_point" class="absolute left-2 transition-all bg-white px-1">
            消費點 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>
    {{-- 知識點 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="knowledge_point" name="knowledge_point" value="{{ old('knowledge_point') }}" type="number" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="knowledge_point" class="absolute left-2 transition-all bg-white px-1">
            知識點 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>


 
    {{-- 送出 --}}
    <input class="hidden" type="submit" value="送出"> 


</form>





@stop


@section('JS-content')
<script type="text/javascript">
// 綁定按鈕監聽器
document.querySelector("#submit-button").addEventListener('click',()=>{
    document.querySelector("form input[type=submit]").click()
})

</script>


@stop