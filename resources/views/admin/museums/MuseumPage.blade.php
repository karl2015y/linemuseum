@extends('admin.layouts.type1')

@section('classification-name', '館舍管理')
@section('title', '館舍單頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('MuseumsPage')}}" class="no-underline text-blue-600">館舍列表頁</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">館舍單頁：{{$museum['name']}}</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        @if($museum['status']=='enable')
        <a href="{{route('EditMuseumPage', ['museum_id'=>$museum->id ])}}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                編輯館舍
            </button>
        </a>
        <button id="disable-museum-modal-open"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-2 rounded">
            封存館舍
        </button>
        @endif
        {{-- <button id="delete-museum-modal-open"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">
            刪除館舍
        </button> --}}
    </div>
</div>

{{-- 個人訊息 --}}
<div class="bg-white w-full rounded-lg shadow-xl">
    <div class="p-4 border-b md:flex justify-between">
        <h2 class="text-2xl ">館舍詳細資料</h2>
        <div>
            <p class="text-sm text-gray-500">
                新增時間：{{ $museum['created_at']->toDateTimeString() }}／
                新增人員：@if ($museum['created_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$museum['created_staff_id']])}}">
                    {{$museum->CreatedStaff->name}}
                </a>
                @else
                無
                @endif
                <br>
                更新時間：{{ $museum['updated_at']->toDateTimeString() }}／
                更新人員：@if ($museum['updated_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$museum['updated_staff_id']])}}">
                    {{$museum->UpdatedStaff->name}}
                </a>
                @else
                無
                @endif
            </p>
            <div class="text-center md:text-right">
                <a href="{{route('KnowledgeActivitiesPage', ['museum_id'=>$museum->id ])}}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded w-full  md:w-1/2">
                        知識點活動列表
                    </button>
                </a>
                <a href="{{route('ShopsPage', ['museum_id'=>$museum->id ])}}">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded w-full mt-1 md:w-2/5">
                        商店列表
                    </button>
                </a>
            </div>

        </div>

    </div>
    <div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                館舍名稱
            </p>
            <p>
                {{$museum['name']}}
                @if($museum['status']=='enable')
                <span class="bg-green-400 text-gray-50 rounded-md px-2">正常</span>
                @else
                <span class="bg-yellow-500 text-gray-50 rounded-md px-2">封存</span>
                @endif
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                館舍信箱
            </p>
            <p>
                {{$museum['email']}}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                館舍地址
            </p>
            <p>
                {{$museum['address']}}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                館舍電話
            </p>
            <p>
                {{$museum['phone']}}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                消費點(點/元)
            </p>
            <p>
                {{$museum['buy_hundred_get_point']}} 點
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                簡介(100字內)
            </p>
            <div>
                @if ($museum['description'])
                {!!$museum['description']!!}
                @else
                無
                @endif
            </div>
        </div>
    </div>


</div>








@stop

@section('JS-content')

{{-- 控制封存modal的開關 --}}
<script type="text/javascript">

</script>




<script>
    window.buttonBindModal('disable-museum-modal-open', '@csrf', 'disable', "是否封存該館舍", "封存後該館舍及無法登入與執行各項業務", "{{route('DisableMuseum', ['museum_id'=>$museum['id'] ])}}")
    window.buttonBindModal('delete-museum-modal-open', '@csrf', 'delete', "是否刪除該館舍", "刪除後該館舍全部的資料將會被銷毀", "{{route('DeleteMuseum', ['museum_id'=>$museum['id'] ])}}")
    
</script>
@stop