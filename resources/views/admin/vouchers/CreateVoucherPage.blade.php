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
            <li class="text-gray-400">新增兌換券頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
            下一步，上傳圖片
        </button>
        <a href="{{route('VouchersPage')}}">
            <button class="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-2 rounded">
                取消
            </button>
        </a>

    </div>
</div>



<form action="{{route('CreateVoucherPage')}}" method="post">
    @csrf

    {{-- 兌換券名稱 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="name" name="name" value="{{ old('name') }}" type="text" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="name" class="absolute left-2 transition-all bg-white px-1">
            兌換券名稱 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>
    {{-- 開始時間 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="start_at" name="start_at" value="{{ old('start_at') }}" type="datetime-local" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="start_at" class="absolute left-2 transition-all bg-white px-1">
            開始時間 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>

    {{-- 結束時間 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="end_at" name="end_at" value="{{ old('end_at') }}" type="datetime-local" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="end_at" class="absolute left-2 transition-all bg-white px-1">
            結束時間 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>


    {{-- 兌換券數量 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="amount" name="amount" value="{{ old('amount') }}" type="number" required
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="amount" class="absolute left-2 transition-all bg-white px-1">
            兌換券數量 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>

    
    {{-- 兌換券類型 --}}
    <div class="pl-2.5 text-gray-500 ">兌換券類型 <span class="text-red-500 font-bold">*</span></div>
        <label class="block text-left">
            <select name="type" class="form-select block w-full mt-1 p-2 border border-solid rounded ">
                <option value="normal">一般兌換券</option>
                <option value="pre">早鳥預購券</option>
            </select>
        </label>
    <br>

    {{-- 兌換券內容 --}}
    <div class="pl-2.5 text-gray-500 ">兌換券內容 <span class="text-red-500 font-bold">*</span></div>
    <textarea class="hidden" id="textarea_description" name="description">{{ old('description') }}</textarea>
    <br>




    {{-- 送出 --}}
    <input class="hidden" type="submit" value="送出">


</form>





@stop


@section('JS-content')
<script type="text/javascript">
    // 富文本
window.createEdit('#textarea_description')
// 綁定按鈕監聽器
document.querySelector("#submit-button").addEventListener('click',()=>{
    document.querySelector("form input[type=submit]").click()
})

</script>




@stop