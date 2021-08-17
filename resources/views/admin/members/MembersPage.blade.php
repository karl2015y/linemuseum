@extends('admin.layouts.type1')

@section('classification-name', '民眾管理(給點)')
@section('title', '民眾列表')




@section('content')


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- 麵包屑 --}}
    <nav class="col-span-2">
        <ol class="list-reset py-4 pl-2 rounded flex bg-grey-light text-grey">
            <li class="text-gray-400">民眾列表</li>
        </ol>
    </nav>
</div>

{{-- 表格區 --}}
{{ $members->links() }}
<table class="table text-gray-800 border-separate space-y-6 text-sm w-full">
    <thead class="text-gray-100 bg-gray-400">
        <tr>
            <th class="py-0.5">#</th>
            <th class="whitespace-nowrap">民眾名稱</th>
            <th class="whitespace-nowrap">民眾性別</th>
            <th class="whitespace-nowrap">連絡電話</th>
            <th class="whitespace-nowrap">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
        <tr class="bg-white shadow-md">
            <td class="p-3  text-center">
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
                {{ $member->gender=='male'?'男':'女' }}
            </td>
            {{-- 連絡電話 --}}
            <td class="p-3 text-center">
                {{ $member->phone }}
            </td>
           
            {{-- 操作 --}}
            <td class="p-3 text-center">
                <a href="{{route('memberPointHistoryPage',['member_id'=>$member->id])}}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                        前往給點頁
                    </button>
        
                </a>
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

    tr td:nth-child(n+5),
    tr th:nth-child(n+5) {
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