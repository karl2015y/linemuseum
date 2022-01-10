@extends('admin.layouts.type1')

@section('classification-name', '數據總攬')
@section('title', '民眾基本資料列表')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            {{-- <li><a href="#" class="no-underline ">Home</a></li>
      <li class="px-2">/</li>
      <li><a href="#" class="no-underline text-blue-600">Library</a></li>
      <li class="px-2">/</li> --}}
            <li class="text-gray-400">民眾基本資料列表</li>
        </ol>
    </nav>

    {{-- 按鍵區 --}}
    <div class="w-100 text-right mb-2 md:mb-0">
        <a href="{{route('MembersExport')}}">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded">
                匯出Excel
            </button>

        </a>

    </div>
</div>

{{-- 表格區 --}}
{{ $members->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
    <thead class="text-gray-100 bg-gray-400">
        <tr>
            <th class="py-0.5">#</th>
            <th class="whitespace-nowrap">民眾名稱</th>
            <th class="whitespace-nowrap">民眾性別</th>
            <th class="whitespace-nowrap">出生年月</th>
            <th class="whitespace-nowrap">居住區域</th>
            <th class="whitespace-nowrap">連絡電話</th>
            <th class="whitespace-nowrap">推薦單位</th>
            <th class="whitespace-nowrap">註冊時間</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
        <tr class="bg-white shadow-md">
            <td class="p-3">
                {{ $member->id }}
            </td>
            {{-- 民眾名稱	 --}}
            <td class="p-3 ">
                <div class="flex align-items-center">
                    <div class="ml-3">
                        <div class="">{{ $member->name }}</div>
                        <div class="text-gray-500">{{ $member->email }}</div>
                    </div>
                </div>
            </td>

            {{-- 民眾性別 --}}
            <td class="p-3 text-center">
                {{-- {{ $member->gender=='male'?'男':'女' }} --}}
                {{ $member->gender=='male'?'男': (($member->gender=='female')?'女':($member->gender)) }}
            </td>
            {{-- 出生年月 --}}
            <td class="p-3 text-center">
                {{ $member->year }} 年
                {{ $member->month }} 月
            </td>
            {{-- 居住區域 --}}
            <td class="p-3 text-center">
                {{ $member->address_region }}
            </td>
            {{-- 連絡電話 --}}
            <td class="p-3 text-center">
                {{ $member->phone }}
            </td>
            {{-- 推薦單位 --}}
            <td class="p-3 text-center">
                {{ $member->recommend_museum }}
            </td>
            {{-- 建立時間 --}}
            <td class="p-3 text-center">
                <div class="mt-3">
                    {{ $member->created_at->toDateTimeString() }}<br>
                    <small>
                        {{ $member->created_at->diffForHumans() }}
                    </small>
                </div>
            </td>


        </tr>
        @endforeach
    </tbody>
</table>
{{ $members->links() }}


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