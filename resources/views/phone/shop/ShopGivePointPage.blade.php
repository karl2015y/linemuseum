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
    <span class="text-xl font-medium">{{$shop->name}}</span>
</div>
<div class="flex flex-col justify-between" style="height: calc(100% - 5.25rem);">
    <div>
        <div class="flex justify-between items-center mx-8 mt-20 pb-6 text-color-main border-solid border-b-2">
            <span class="mt-2 text-xl font-medium">兌換比例</span>
            <span id="point_percent" class="text-4xl font-medium">{{$shop->museum->buy_hundred_get_point}}</span>
            <span class="mt-2 text-xl font-medium">點／元</span>
        </div>
        <div class="flex justify-between mx-8 pt-7 text-color-main border-solid border-t-2">
            <span class="text-xl font-medium">消費金額</span>
            <span class="text-xl font-medium">／元</span>
        </div>
     
    </div>

    <div class="mx-auto mx-8 border-solid border rounded w-10/12 h-20 p-0.5 text-color-main ">
        <input class="w-full h-full text-center outline-none text-gray-900 " type="number"  id="givepoint"
            placeholder="在此輸入消費金額">
    </div>
    <div class="text-center flex flex-col">
        <span class="text-xl font-medium">預計可獲得消費點</span>
        <span id="final_can_get_point" class="text-5xl my-4 font-bold text-color-third">0</span>
        <span class="text-xl font-medium">點</span>
    </div>
    <div class="flex justify-between w-screen">
        <div class="w-full">
            <form action="{{route('ShopGivePoint')}}" method="post">
                @csrf
                <input class="hidden" type="number" name="point" id="point" value="0">
                <input class="hidden" type="number" name="price" id="price" value="0">
                <button
                    class="w-full py-6 text-white text-color-main shadow-inner block md:inline-block font-medium">送出</button>
            </form>
        </div>
        <div class="w-full">
            <a href="{{route('ShopDatasPage')}}">
                <button
                    class="w-full py-6 text-white text-color-main shadow-inner block md:inline-block font-medium">取消</button>
            </a>
        </div>
    </div>
</div>

@stop

@section('js-content')
<script>
    // 監聽輸入框，並計算最終給點
    const _givepoint = document.querySelector("#givepoint");
    const _point = document.querySelector("#point");
    const _price = document.querySelector("#price");
    const _final_can_get_point = document.querySelector("#final_can_get_point");
    const _point_percent = document.querySelector("#point_percent")
    _givepoint.addEventListener('input',()=>{
        _price.value = _givepoint.value;
        _point.value = _point_percent.textContent * _givepoint.value;
        _final_can_get_point.textContent=_point.value;
    })

</script>
@stop