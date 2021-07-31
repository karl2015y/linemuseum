@extends('admin.layouts.type1')

@section('classification-name', '知識點活動管理')
@section('title', '編輯知識點活動頁')




@section('content')



<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('MuseumPage', ['museum_id'=>$museum->id])}}" class="no-underline text-blue-600">{{$museum['name']}}</a></li>
            <li class="px-2">/</li>
            <li><a href="{{route('KnowledgeActivitiesPage', ['museum_id'=>$museum['id']])}}" class="no-underline text-blue-600">知識點活動列表頁</a></li>
            <li class="px-2">/</li> 
            <li><a href="{{route('KnowledgeActivityPage', ['museum_id'=>$museum['id'], 'ka_id'=>$ka['id'] ])}}" class="no-underline text-blue-600">知識點活動單頁：{{$ka['name']}}</a></li>
            <li class="px-2">/</li> 
            <li class="text-gray-400">編輯知識點活動頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <button id="submit-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
            儲存
        </button>
        <a href="{{route('KnowledgeActivityPage', ['museum_id'=>$museum['id'], 'ka_id'=>$ka['id'] ])}}">
            <button class="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-2 rounded">
                取消
            </button>
        </a>
       
    </div>
</div>



<form action="{{route('EditKnowledgeActivity', ['museum_id'=>$museum['id'], 'ka_id'=>$ka['id'] ])}}" method="post">
    @csrf
    @method('PUT')
    {{-- 知識點活動名稱 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="name" name="name" value="{{ old('name', $ka['name']) }}" type="text" 
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="name" class="absolute left-2 transition-all bg-white px-1">
            知識點活動名稱 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>

    {{-- 開始時間 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="start_at" name="start_at" value="{{ old('start_at', str_replace(' ','T',$ka['start_at']) ) }}" type="datetime-local" 
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="start_at" class="absolute left-2 transition-all bg-white px-1">
            開始時間 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>
    
    {{-- 結束時間 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="end_at" name="end_at" value="{{ old('end_at', str_replace(' ','T',$ka['end_at'])) }}" type="datetime-local" 
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="end_at" class="absolute left-2 transition-all bg-white px-1">
            結束時間 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>

    {{-- 給予知識點 --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="point" name="point" value="{{ old('point', $ka['point']) }}" type="number" 
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="point" class="absolute left-2 transition-all bg-white px-1">
            給予知識點 <span class="text-red-500 font-bold">*</span>
        </label>
    </div>

    {{-- 獲得週期(小時) --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="point_cycle_hour" name="point_cycle_hour" value="{{ old('point_cycle_hour', $ka['point_cycle_hour']) }}" type="number" 
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="point_cycle_hour" class="absolute left-2 transition-all bg-white px-1">
            獲得週期(小時) <span class="text-red-500 font-bold">*</span>
        </label>
    </div>

    {{-- 獲得週期(分鐘) --}}
    <div class="relative h-10 input-component mb-5 formInputGroup">
        <input id="point_cycle_min" name="point_cycle_min" value="{{ old('point_cycle_min', $ka['point_cycle_min']) }}" type="number" 
            class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm" />
        <label for="point_cycle_min" class="absolute left-2 transition-all bg-white px-1">
            獲得週期(分鐘) <span class="text-red-500 font-bold">*</span>
        </label>
    </div>




    {{-- 簡介限制100字 --}}
    <div class="pl-2.5 text-gray-500 ">簡介(100字內)</div>
    <textarea class="hidden" id="textarea_description" name="description">{{ old('description',$ka['description']) }}</textarea> <br>

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