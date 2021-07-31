@extends('admin.layouts.type1')

@section('classification-name', '商家管理')
@section('title', '編輯商家頁')




@section('content')



<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('MuseumPage', ['museum_id'=>$museum->id])}}" class="no-underline text-blue-600">{{$museum['name']}}</a></li>
            <li class="px-2">/</li>
            <li><a href="{{route('ShopsPage', ['museum_id'=>$museum['id']])}}" class="no-underline text-blue-600">商家列表頁</a></li>
            <li class="px-2">/</li> 
            <li><a href="{{route('ShopPage', ['museum_id'=>$museum['id'], 'shop_id'=>$shop['id'] ])}}" class="no-underline text-blue-600">商家單頁：{{$shop['name']}}</a></li>
            <li class="px-2">/</li> 
            <li class="text-gray-400">編輯商家頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
            儲存
        </button>
        <a href="{{route('ShopPage', ['museum_id'=>$museum['id'], 'shop_id'=>$shop['id'] ])}}">
            <button class="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-2 rounded">
                取消
            </button>
        </a>
       
    </div>
</div>



<form action="{{route('EditShop', ['museum_id'=>$museum['id'], 'shop_id'=>$shop['id'] ])}}" method="post">
    @csrf
    @method('PUT')
    {{-- 商家名稱 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="name" name="name" value="{{ old('name', $shop['name']) }}" type="text" 
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="name" class="absolute left-2 transition-all bg-white px-1">
            商家名稱 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>


    {{-- 商家密碼 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="password" name="password" value="{{ old('password') }}" type="password"
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="password" class="absolute left-2 transition-all bg-white px-1">
            商家密碼 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>
    {{-- 密碼確認 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" type="password"
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="password_confirmation" class="absolute left-2 transition-all bg-white px-1">
            密碼確認 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>
    {{-- 簡介限制100字 --}}
    <div class="pl-2.5 text-gray-500 ">簡介(100字內)</div>
    <textarea class="hidden" id="textarea_description" name="description">{{ old('description',$shop['description']) }}</textarea> <br>

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