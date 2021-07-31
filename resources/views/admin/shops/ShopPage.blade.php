@extends('admin.layouts.type1')

@section('classification-name', '商家管理')
@section('title', '商家單頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('MuseumPage', ['museum_id'=>$museum->id])}}" class="no-underline text-blue-600">{{$museum['name']}}</a></li>
            <li class="px-2">/</li>
            <li><a href="{{route('ShopsPage',['museum_id'=>$museum->id])}}" class="no-underline text-blue-600">商家列表頁</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">商家單頁：{{$shop['name']}}</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        @if($shop['status']=='enable')
        <a href="{{route('EditShopPage', ['museum_id'=>$museum->id,'shop_id'=>$shop->id ])}}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                編輯商家
            </button>
        </a>
        <button id="disable-shop-modal-open"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-2 rounded">
            封存商家
        </button>
        @endif
        <button id="delete-shop-modal-open"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">
            刪除商家
        </button>
    </div>
</div>

{{-- 個人訊息 --}}
<div class="bg-white w-full rounded-lg shadow-xl">
    <div class="p-4 border-b md:flex justify-between">
        <h2 class="text-2xl ">商家詳細資料</h2>
        <div>
            <p class="text-sm text-gray-500">
                新增時間：{{ $shop['created_at']->toDateTimeString() }}／
                新增人員：@if ($shop['created_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$shop['created_staff_id']])}}">
                    {{$shop->CreatedStaff->name}}
                </a>
                @else
                無
                @endif
                <br>
                更新時間：{{ $shop['updated_at']->toDateTimeString() }}／
                更新人員：@if ($shop['updated_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$shop['updated_staff_id']])}}">
                    {{$shop->UpdatedStaff->name}}
                </a>
                @else
                無
                @endif
            </p>
            <div class="text-center md:text-right">
                <a href="{{route('ShopsPage', ['museum_id'=>$museum->id ])}}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded w-full ">
                        消費紀錄列表
                    </button>
                </a>
            </div>

        </div>

    </div>
    <div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                商家名稱
            </p>
            <p>
                {{$shop['name']}}
                @if($shop['status']=='enable')
                <span class="bg-green-400 text-gray-50 rounded-md px-2">正常</span>
                @else
                <span class="bg-yellow-500 text-gray-50 rounded-md px-2">封存</span>
                @endif
            </p>
        </div>


        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                商家電話
            </p>
            <p>
                {{$shop['phone']}}
            </p>
        </div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                消費百元送
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
                @if ($shop['description'])
                {!!$shop['description']!!}
                @else
                無
                @endif
            </div>
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
    window.buttonBindModal('disable-shop-modal-open', '@csrf', 'disable', "是否封存該商家", "封存後該商家及無法登入與執行各項業務", "{{route('DisableShop',  ['museum_id'=>$museum->id,  'shop_id'=>$shop->id ])}}")
    window.buttonBindModal('delete-shop-modal-open', '@csrf', 'delete', "是否刪除該商家", "刪除後該商家全部的資料將會被銷毀", "{{route('DeleteShop',  ['museum_id'=>$museum->id,  'shop_id'=>$shop->id ])}}")
    
</script>
@stop