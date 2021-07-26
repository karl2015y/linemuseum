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


{{-- 封存總管人員 --}}
<div id="modal-id" style="z-index: 60000"
    class="hidden min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
    <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
        <!--content-->
        <div class="">
            <!--body-->
            <div class="text-center p-5 flex-auto justify-center">
                <svg class="w-16 h-16 flex items-center text-yellow-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <h2 class="text-xl font-bold py-4 ">是否封存該總管人員</h3>
                    <p class="text-sm text-gray-500 px-8">封存後該人員及無法登入與執行各項業務</p>
            </div>
            <!--footer-->
            <div class="p-3  mt-2 text-center space-x-4 md:block">
                <button id="disable-staff-modal-close"
                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                    取消
                </button>
                <form class="inline-block" action="{{route('DisableStaff', ['staff_id'=>$staff['id'] ])}}" method="post">
                    @csrf
                    @method('PUT')
                    <button
                        class="mb-2 md:mb-0 bg-yellow-500 border border-yellow-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-yellow-600">
                        確定封存
                    </button> 
                </form>
        
            </div>
        </div>
    </div>
</div>




@stop

@section('JS-content')

{{-- 控制封存modal的開關 --}}
<script type="text/javascript">
    document.querySelector('#disable-staff-modal-open').addEventListener('click',()=>{
    document.querySelector("#modal-id").classList.remove('hidden')
})
document.querySelector('#disable-staff-modal-close').addEventListener('click',()=>{
    document.querySelector("#modal-id").classList.add('hidden')
})
</script>
@stop