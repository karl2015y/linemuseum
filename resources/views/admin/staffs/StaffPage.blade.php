@extends('admin.layouts.type1')

@section('classification-name', '總管人員管理')
@section('title', '總管人員單頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('StaffsPage')}}" class="no-underline text-blue-600">總管人員頁</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">總管人員單頁：{{$staff['name']}}</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    @if($staff['status']=='enable')
    <div class="w-100 text-right mb-2 md:mb-0">
        <a href="{{route('EditStaffPage', ['staff_id'=>$staff->id ])}}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                編輯總管人員
            </button>
        </a>
        <button id="disable-staff-modal-open"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-2 rounded">
            封存總管人員
        </button>
    </div>
    @endif
</div>

{{-- 個人訊息 --}}
<div class="max-w-4xl  bg-white w-full rounded-lg shadow-xl">
    <div class="p-4 border-b flex justify-between">
        <h2 class="text-2xl ">
            總館人員詳細資料
        </h2>
        <p class="text-sm text-gray-500">
            新增時間：{{ $staff['created_at']->toDateTimeString() }}／
            新增人員：@if ($staff['created_staff_id'])
            <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$staff['created_staff_id']])}}">
                {{$staff->CreatedStaff->name}}
            </a>
            @else
            無
            @endif
            <br>
            更新時間：{{ $staff['updated_at']->toDateTimeString() }}／
            更新人員：@if ($staff['updated_staff_id'])
            <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$staff['updated_staff_id']])}}">
                {{$staff->UpdatedStaff->name}}
            </a>
            @else
            無
            @endif
        </p>
    </div>
    <div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                名稱
            </p>
            <p>
                {{$staff['name']}} 
                @if($staff['status']=='enable')
                    <span class="bg-green-400 text-gray-50 rounded-md px-2">正常</span>
                @else
                    <span class="bg-yellow-500 text-gray-50 rounded-md px-2">封存</span> 
                @endif
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                信箱
            </p>
            <p>
                {{$staff['email']}}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                簡介(100字內)
            </p>
            <div>
                {!!$staff['description']!!}
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


window.buttonBindModal('disable-staff-modal-open', '@csrf', 'disable', "是否封存該總管人員", "封存後該人員及無法登入與執行各項業務", "{{route('DisableStaff', ['staff_id'=>$staff['id'] ])}}")

</script>
@stop