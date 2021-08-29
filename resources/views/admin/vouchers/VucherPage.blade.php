@extends('admin.layouts.type1')

@section('classification-name', '兌換券管理')
@section('title', '兌換券單頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('VouchersPage')}}" class="no-underline text-blue-600">兌換券列表頁</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">兌換券單頁：{{$voucher['name']}}</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        @if($voucher['status']=='enable')
        
        <button id="disable-voucher-modal-open"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-2 rounded">
            封存兌換券
        </button>
        @endif
        <button id="delete-voucher-modal-open"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">
            刪除兌換券
        </button>
    </div>
</div>

{{-- 個人訊息 --}}
<div class="bg-white w-full rounded-lg shadow-xl">
    <div class="p-4 border-b md:flex justify-between">
        <h2 class="text-2xl ">兌換券詳細資料</h2>
        <div>
            <p class="text-sm text-gray-500">
                新增時間：{{ $voucher['created_at']->toDateTimeString() }}／
                新增人員：@if ($voucher['created_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$voucher['created_staff_id']])}}">
                    {{$voucher->CreatedStaff->name}}
                </a>
                @else
                無
                @endif
                <br>
                更新時間：{{ $voucher['updated_at']->toDateTimeString() }}／
                更新人員：@if ($voucher['updated_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$voucher['updated_staff_id']])}}">
                    {{$voucher->UpdatedStaff->name}}
                </a>
                @else
                無
                @endif
            </p>
        </div>

    </div>
    <div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                兌換券名稱
            </p>
            <p>
                {{$voucher['name']}}
                @if($voucher['status']=='enable')
                <span class="bg-green-400 text-gray-50 rounded-md px-2">正常</span>
                @else
                <span class="bg-yellow-500 text-gray-50 rounded-md px-2">封存</span>
                @endif
            </p>
        </div>

        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                開始時間
            </p>
            <p>
                {{$voucher['start_at']->toDateTimeString()}}
                <small>
                    ({{$voucher['start_at']->diffForHumans()}})
                </small>
            </p>
        </div>


        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                結束時間
            </p>
            <p>
                {{$voucher['end_at']}}
                <small>
                    ({{$voucher['end_at']->diffForHumans()}})
                </small>
            </p>
        </div>

        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                兌換券數量
            </p>
            <p>
                {{$voucher['amount']}} 張
            </p>
        </div>

        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                購買方式
                @if($voucher['status']=='enable')
                <a href="{{route('CreateBuyVoucherWayPage', ['voucher_id'=>$voucher->id ])}}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-1 px-2 rounded">
                        新增購買方式
                    </button>
                </a>
                @endif
            </p>
            <p>

                @foreach ( $voucher['voucherWay'] as $index => $vw )
                <span>
                    {{$index+1}}. {{$vw->pay_point}}點消費點 和 {{$vw->knowledge_point}}點知識點
                </span>
                @if($voucher['status']=='enable')
                <button id="delete-voucher-way-{{$vw->id}}-modal-open"
                    class=" ml-2 mb-1 bg-red-500 hover:bg-red-700 text-white font-bold text-sm py-0.5 px-2 rounded">
                    刪除
                </button>
                @endif
                <br>

                @endforeach


            </p>
        </div>

        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                簡介(100字內)
            </p>
            <div>
                @if ($voucher['description'])
                {!!$voucher['description']!!}
                @else
                無
                @endif
            </div>
        </div>

        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <div>
                @if($voucher['status']=='enable')
                <a href="{{route('CreateVoucherPicsPage', ['voucher_id'=>$voucher->id, 'mode'=>'edit' ])}}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-1 px-2 rounded">
                        編輯圖片
                    </button>
                </a>
                @endif
                <br>
                <span>小圖片 (350 x 350)</span>
                <img class="mt-1 shadow"  style="width: 350px; height:350px" src="/storage/vouchers/{{$voucher->id}}/pic1.jpg" alt="">
            </div>
            <div class="pt-6">
                <span>大圖片 (350 x 790)</span>
                <img class="mt-1 shadow" style="width: 350px; height:790px" src="/storage/vouchers/{{$voucher->id}}/pic2.jpg" alt="">
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
    window.buttonBindModal('disable-voucher-modal-open', '@csrf', 'disable', "是否封存該兌換券", "封存後該兌換券無法再被修改與購買，但民眾已購買的券還是可以做兌換", "{{route('DisableVucher', ['voucher_id'=>$voucher['id'] ])}}")
    window.buttonBindModal('delete-voucher-modal-open', '@csrf', 'delete', "是否刪除該兌換券", "刪除後該兌換券全部的資料將會被銷毀無法再被查閱，但民眾已購買的券還是可以做兌換", "{{route('DeleteVucher', ['voucher_id'=>$voucher['id'] ])}}")
    
</script>

@foreach ( $voucher['voucherWay'] as $index => $vw )
<script>
    window.buttonBindModal('delete-voucher-way-{{$vw->id}}-modal-open', '@csrf', 'delete', "是否刪除該購買方式", "刪除後該民眾將無發透過該方法購買兌換券", "{{route('DeleteBuyVoucherWay', ['voucher_id'=>$voucher['id'], 'voucher_way_id'=>$vw['id'] ])}}")
</script>
@endforeach

@stop