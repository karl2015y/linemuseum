@extends('admin.layouts.type1')

@section('classification-name', '系統參數管理')
@section('title', '編輯系統參數頁')




@section('content')



<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li class="text-gray-400">編輯系統參數頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
            更新
        </button>
    </div>
</div>
<div class="text-right">
    @if ($setting['updated_staff_id'])
    <p class="text-sm text-gray-500">
        更新時間：{{ $setting['updated_at']->toDateTimeString() }}／
        更新人員：
        <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$setting['updated_staff_id']])}}">
            {{$setting->UpdatedStaff->name}}
        </a>
    </p>
    <br>
    @endif

</div>







<form action="{{route('setConfig')}}" method="post">
    @csrf
    {{-- 註冊給知識點 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="singup_get_point" name="singup_get_point"
            value="{{ old('singup_get_point', $setting['singup_get_point']) }}" type="number"
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="singup_get_point" class="absolute left-2 transition-all bg-white px-1">
            註冊給知識點 <span class="text-red-500 font-bold">*</span>
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