@extends('phone.layout.type2')
@section('title', '館舍管理')
@section('content')
{{-- topbar --}}
<div class="relative text-center pb-2 pt-12 bg-color-sec">
    <a href="{{route('ShopDatasPage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    <span class="text-xl font-medium">{{$ppr->shop_name}}</span>
</div>
<div class="flex flex-col justify-around" style="height: calc(100% - 5.25rem);">
    <div>
        <div class="flex justify-between items-center mx-8 mt-20 pb-6 text-color-main border-solid border-b-2">
            <span class="mt-2 text-xl font-medium">兌換比例</span>
            <span id="point_percent" class="text-4xl font-medium">{{$museum->buy_hundred_get_point}}</span>
            <span class="mt-2 text-xl font-medium">點／百元</span>
        </div>
        <div class="flex justify-between mx-8 pt-7 text-color-main border-solid border-t-2">
            <span class="text-xl font-medium">消費金額</span>
            <span class="text-xl font-medium">／元</span>
        </div>
    </div>
    <div class="h-44 mx-auto my-8 p-0.5 rounded w-44">
        <span class="qrcode">
            {!! QrCode::size(200)->generate(route('QrcodeGetPoint',['uuid'=>$qr->id])); !!}
        </span>
    </div>
    <div class="text-center flex flex-col">
        <span class="text-xl font-medium">預計可獲得消費點</span>
        <span class="text-5xl my-4 font-bold text-color-third">{{$ppr->point}}</span>
        <span class="text-xl font-medium">點</span>
    </div>
    <div class="flex justify-between mt-auto">
        <div class="w-full">
            <a href="{{route('ShopDatasPage')}}">
                <button class="w-full py-6 text-white text-color-main shadow-inner font-medium block md:inline-block">關
                    閉</button>
            </a>
        </div>
    </div>
</div>



@stop


@section('JS-content')
<script>
    
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