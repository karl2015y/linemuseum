@extends('admin.layouts.type1')

@section('classification-name', '知識點活動管理')
@section('title', '知識點活動單頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li><a href="{{route('MuseumPage', ['museum_id'=>$museum->id])}}"
                    class="no-underline text-blue-600">{{$museum['name']}}</a></li>
            <li class="px-2">/</li>
            <li><a href="{{route('KnowledgeActivitiesPage',['museum_id'=>$museum->id])}}"
                    class="no-underline text-blue-600">知識點活動列表頁</a></li>
            <li class="px-2">/</li>
            <li class="text-gray-400">知識點活動單頁：{{$ka['name']}}</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        @if($ka['status']=='enable')
        <a href="{{route('EditKnowledgeActivityPage', ['museum_id'=>$museum->id,'ka_id'=>$ka->id ])}}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                編輯活動
            </button>
        </a>
        <button id="disable-ka-modal-open"
            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-2 rounded">
            封存活動
        </button>
        @endif
        {{-- <button id="delete-ka-modal-open" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">
            刪除活動
        </button> --}}
    </div>
</div>

{{-- 個人訊息 --}}
<div class="bg-white w-full rounded-lg shadow-xl">
    <div class="p-4 border-b md:flex justify-between">
        <h2 class="text-2xl ">知識點活動詳細資料</h2>
        <div>
            <p class="text-sm text-gray-500">
                新增時間：{{ $ka['created_at']->toDateTimeString() }}／
                新增人員：@if ($ka['created_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$ka['created_staff_id']])}}">
                    {{$ka->CreatedStaff->name}}
                </a>
                @else
                無
                @endif
                <br>
                更新時間：{{ $ka['updated_at']->toDateTimeString() }}／
                更新人員：@if ($ka['updated_staff_id'])
                <a class="text-blue-600" href="{{route('StaffPage', ['staff_id'=>$ka['updated_staff_id']])}}">
                    {{$ka->UpdatedStaff->name}}
                </a>
                @else
                無
                @endif
            </p>
            <div class="text-center md:text-right">
                <a href="{{route('KnowledgeActivityHistoryPage', ['museum_id'=>$museum->id,  'ka_id'=>$ka->id ])}}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded w-full ">
                        參與活動紀錄列表頁
                    </button>
                </a>
            </div>

        </div>

    </div>
    <div>
        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                知識點活動名稱
            </p>
            <p>
                {{$ka['name']}}
                @if($ka['status']=='enable')
                <span class="bg-green-400 text-gray-50 rounded-md px-2">正常</span>
                @else
                <span class="bg-yellow-500 text-gray-50 rounded-md px-2">封存</span>
                @endif
            </p>
        </div>

        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                參與活動 Qrcoded
            </p>
            <p>
                <span class="font-bold">參與連結 </span>
                <br>
                <span>
                    {{route('QrcodeGetPoint',['uuid'=>$ka->QRcode->id])}}
                </span>
                <br>
                <span class="font-bold">參與Qrcode</span>
                <span class="qrcode">
                    {!! QrCode::size(200)->generate(route('QrcodeGetPoint',['uuid'=>$ka->QRcode->id])); !!}
                </span>
                {{-- <a class="text-blue-500" href="{{route('QrcodeGetPoint',['uuid'=>$ka->QRcode->id])}}">連結</a> --}}

            </p>
        </div>

        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                開始時間
            </p>
            <p>
                {{$ka['start_at']->toDateTimeString()}}
                <small>
                    ({{$ka['start_at']->diffForHumans()}})
                </small>
            </p>
        </div>


        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                結束時間
            </p>
            <p>
                {{$ka['end_at']}}
                <small>
                    ({{$ka['end_at']->diffForHumans()}})
                </small>
            </p>
        </div>


        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                給予知識點
            </p>
            <p>
                {{$ka['point']}} 點
            </p>
        </div>


        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                獲得週期
            </p>
            <p>
                {{$ka['point_cycle_hour']}}個小時 又 {{$ka['point_cycle_min']}} 分鐘
            </p>
        </div>




        <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
            <p class="text-gray-600">
                簡介(100字內)
            </p>
            <div>
                @if ($ka['description'])
                {!!$ka['description']!!}
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
    window.buttonBindModal('disable-ka-modal-open', '@csrf', 'disable', "是否封存該知識點活動", "封存後該知識點活動及無法登入與執行各項業務", "{{route('DisableKnowledgeActivity',  ['museum_id'=>$museum->id,  'ka_id'=>$ka->id ])}}")
    window.buttonBindModal('delete-ka-modal-open', '@csrf', 'delete', "是否刪除該知識點活動", "刪除後該知識點活動全部的資料將會被銷毀", "{{route('DeleteKnowledgeActivity',  ['museum_id'=>$museum->id,  'ka_id'=>$ka->id ])}}")


 
    const svg = document.querySelector('.qrcode svg');
    const canvas = document.createElement('canvas');
    canvas.width = svg.getBoundingClientRect().width;
    canvas.height = svg.getBoundingClientRect().height;
    svg.parentElement.appendChild(canvas);
    const  svg_xml = (new XMLSerializer()).serializeToString(svg);
    const ctx = canvas.getContext('2d');
    const img = new Image();
    img.onload = function() {
        ctx.drawImage(img, 0, 0);
    };
    img.src = 'data:image/svg+xml;base64,' + btoa(svg_xml);
    svg.remove();




</script>
@stop