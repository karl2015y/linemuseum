@extends('admin.layouts.type1')

@section('classification-name', '數據總攬')
@section('title', '消耗點數發放列表頁')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            {{-- <li><a href="#" class="no-underline ">Home</a></li>
      <li class="px-2">/</li>
      <li><a href="#" class="no-underline text-blue-600">Library</a></li>
      <li class="px-2">/</li> --}}
            <li class="text-gray-400">消耗點數發放列表頁</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <a href="{{route('PayPointHistoryExport')}}">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                匯出Excel
            </button>

        </a>

    </div>
</div>


{{-- 篩選器 --}}
<div class="flex text-sm mb-3">
    <div class="inline-flex ">
        <a href="#">
            <span 
                class="shadow font-bold bg-blue-500 text-white rounded-l-lg  border border-double border-r-0 border-gray-300 radio text-center self-center py-1 px-4  cursor-pointer hover:opacity-75">
                消費點
            </span>
        </a>


    </div>
    <div class="inline-flex ">
        <a href="{{route('KnowledgePointHistoryPage')}}">
            <span
                class="rounded-r-lg border border-double border-l-0 border-gray-300 radio text-center self-center py-1 px-4  cursor-pointer hover:opacity-75">
                知識點
        </span>
        </a>
    </div>
</div>



{{-- 表格區 --}}
{{ $PPRs->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
    <thead class="text-gray-100 bg-gray-400">
        <tr>
            <th class="py-0.5">#</th>
            <th class="whitespace-nowrap">民眾名稱</th>
            <th class="whitespace-nowrap">館舍名稱</th>
            <th class="whitespace-nowrap">商店名稱</th>
            <th class="whitespace-nowrap">消費金額</th>
            <th class="whitespace-nowrap">獲得消費點</th>
            <th class="whitespace-nowrap">參與時間</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($PPRs as $PPR)
        <tr class="bg-white shadow-md">
            <td class="p-3 text-center">
                {{ $PPR->id }}
            </td>
            {{-- 民眾名稱 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $PPR->member_name }}
                </div>
            </td>

            {{-- 館舍名稱 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    <a class="no-underline text-blue-600"
                        href="{{route('MuseumPage' ,['museum_id'=>$PPR->shop->museum->id])}}">
                        {{ $PPR->shop->museum->name }}
                    </a>
                </div>
            </td>
            {{-- 商店名稱 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    <a class="no-underline text-blue-600"
                        href="{{route('ShopPage' ,['museum_id'=>$PPR->shop->museum->id,'shop_id'=>$PPR->shop->id])}}">
                        {{ $PPR->shop_name }}
                    </a>
                </div>
            </td>
            {{-- 消費金額 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $PPR->price }} 元
                </div>
            </td>
            {{-- 獲得知識點 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $PPR->point }} 點
                </div>
            </td>

            {{-- 建立時間 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $PPR->created_at->toDateTimeString() }} <br>
                    <small>
                        {{ $PPR->created_at->diffForHumans() }}
                    </small>
                </div>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
{{ $PPRs->links() }}


<style>
    .table {
        border-spacing: 0 15px;
    }

    i {
        font-size: 1rem !important;
    }

    .table tr {
        border-radius: 20px;
    }

    tr td:nth-child(n+8),
    tr th:nth-child(n+8) {
        border-radius: 0 .625rem .625rem 0;
    }

    tr td:nth-child(1),
    tr th:nth-child(1) {
        border-radius: .625rem 0 0 .625rem;
    }
</style>


@stop

@section('JS-content')

@stop