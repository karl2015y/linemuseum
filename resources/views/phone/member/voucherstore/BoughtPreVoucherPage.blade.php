@extends('phone.layout.type3')
@section('title', '預購商品')
@section('content')

{{-- topbar --}}
<div id="toptitle" class="relative text-center  pb-2 pt-12 bg-color-sec">
    <a v-show="step==1" href="{{route('VouchersStorePage')}}">
        <div class="absolute left-4 rounded-full p-1 pl-0.5 bg-white bottom-3 text-color-main">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </div>
    </a>
    <span class="text-xl font-medium">預購商品</span>
</div>
<div id="toptitleSpace" class="hidden w-full h-24"></div>

{{-- shops --}}
<div class="pb-4 overflow-x-hidden overflow-y-auto px-3">
    {{-- 購買步驟 --}}
    <div class="flex text-sm justify-around py-4 items-center text-gray-400 ">
        <div :class="{'bg-color-main text-white rounded px-2 py-1.5':step==1,'px-2 py-1.5 border-solid border rounded border-gray-500 text-gray-500':step!=1}">
            1.填寫收件人資料</div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <div
            :class="{'bg-color-main text-white rounded px-2 py-1.5':step==2,'px-2 py-1.5 border-solid border rounded border-gray-500 text-gray-500':step!=2}">
            2.確認資料</div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <div
            :class="{'bg-color-main text-white rounded px-2 py-1.5':step==3,'px-2 py-1.5 border-solid border rounded border-gray-500 text-gray-500':step!=3}">
            3.確認送出</div>
    </div>
    {{-- 第三步 --}}
    <div v-if="step==3" class="px-1">
        <div>
            <h1 class="font-bold text-3xl text-color-third">恭喜您預購成功！</h1>
            <h2 class="text-xl mt-2">以下是您此次預購的商品細節：</h2>
            {{-- 商品細節 --}}
            <div class="mt-2">
                <div class="flex bg-gray-50 py-6 rounded shadow">
                    <div class="mx-3">
                        <img class="w-36 h-36 mx-auto object-cover rounded-2xl shadow"
                        :src="prebuy.img" alt=""/>
                    </div>
                    <div class="-mt-1">
                        <h3 class="text-gray-500">商品名稱</h3>
                        <h4 class="font-bold" v-html="prebuy.name"></h4>
                        <h3 class="text-gray-500">預購數量</h3>
                        <h4 class="font-bold">1</h4>
                        <h3 class="text-gray-500">所需點數</h3>
                        <h4 class="font-bold">@{{prebuy.need_point}}</h4>
                    </div>
                </div>
            </div>
            {{-- 收件資料 --}}
            <div class="mt-8">
               <p>
                商品將於預定時間出貨,出貨前系統將自動發送
                出貨通知信至訂購人e-mail,可登入「藝點通」至
                我的兌換券」「預購券」查詢您的訂單動態。
                <br>
                <br>
                謝謝您
               </p>
               <img class="w-32 h-12 mt-6 ml-1" src="/asset/img/logo-row.png">
            </div>
        </div>
        <div>
            {{-- 下一步 --}}
            <form action="{{route('VouchersStorePage')}}" method="get">
                @csrf
                <button 
                    class="w-10/12 mx-auto mt-16 py-2 px-6 text-white rounded bg-color-main shadow block md:inline-block">
                    查 看 更 多
                </button>                
            </form>
        </div>
    </div>

</div>
@stop





@section('js-content')


<script>
    var app = new Vue({
  el: '#app',
  data: {
    prebuy:{
        name:'{!!$voucher->name!!}',
        need_point:'{{$voucher_way->text}}',
        img:'{{$voucher->pic_1}}?t={{rand()}}'
    },

    step:3,
  },

})


</script>
@stop